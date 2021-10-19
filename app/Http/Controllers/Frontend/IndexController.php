<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/* included models */
use App\Models\VisitorType;
use App\Models\UserType;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use App\Models\ForgotPassword;

// Include Mail
use App\Mail\ForgetPassword;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display visitor registration page
     */
    public function register()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();

        return view('frontend.pages.register', compact('visitor_types'));
    }

    /**
     * Display about us page
     */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /**
     * Display contact us page
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }


    /**
     * Display Employee Registration page
     */
    public function employeeCreate()
    {
        $user_types = UserType::where([
                                    ['user_type_status' , '=', '1'],
                                    ['user_type_id' , '=', '2'],
                                ])
                                ->orWhere([
                                    ['user_type_status' , '=', '1'],
                                    ['user_type_id' , '=', '3'],
                                ])
                                ->get();
        $departments = Department::where('status', '=', 1)
                                ->orderBy('dept_id', 'asc')
                                ->get();
        $designations = Designation::where('status', '=', 1)
                                    ->orderBy('designation_id', 'asc')
                                    ->get();

        return view('frontend.pages.employee-register', compact('user_types', 'departments', 'designations'));
    }

    /**
     * Display Forgot password form
     */
    public function forgotPassword()
    {
        return view('frontend.pages.forgot_password');
    }

    /**
     * Generate forget password token
     */
    public function generateToken(Request $req)
    {
        $user = User::where('mobile_no', $req->mobile_email)
                    ->orWhere('email', $req->mobile_email)
                    ->first();

        $uniqueDatetime = date('Ymdhis');
        $str = rand();
        $mdstr = md5($str);
        $token = $uniqueDatetime . $mdstr;

        // Check if user have active forgot_password token
        $activeToken = ForgotPassword::where('user_id', $user->user_id)
                                     ->where('status', 1)
                                     ->first();
        if ($activeToken)
        {
            return redirect()->back()->with('sticky_error', 'User already have Active forgetpassword token, Please check your email inbox...!');
        }

        // insert data into forgot_passwords table
        $forgotPassword = new ForgotPassword;
        $forgotPassword->user_id = $user->user_id;
        $forgotPassword->token = $token;
        $forgotPassword->issue_datetime = now();
        $forgotPassword->status = 1;
        $done = $forgotPassword->save();

        // Data to send in mail
        $mailData = [
            'token' => $token,
            'user_id' => $user->user_id
        ];

        if ($done)
        {
            mail::to($user->email)->send(new ForgetPassword($mailData));
            return redirect()->back()->with('success', 'Forget Password Token generate successfully. Please check '. $user->email . ' inbox and follow the instruction');
        } else {
            return redirect()->back()->with('sticky_error', 'Something went wrong, Please try again later or contract admin');
        }
    }

    /**
     * Display reset password form
     */
    public function resetPassword($user_id, $token)
    {
        return view('frontend.pages.reset_password', compact('user_id', 'token'));
    }

    /**
     * Update new password
     */
    public function resetPasswordStore(Request $req)
    {
        $req->validate([
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        $forgotPassword = ForgotPassword::where('user_id', $req->user_id)->where('token', $req->token)->where('status', 1)->first();
        if (!$forgotPassword)
        {
            return redirect()->route('index')->with('sticky_error', 'You already used this link, Please generate a new link...!');
        }
        $forgotPassword->use_datetime = now();
        $forgotPassword->status = 0;
        $forgotPassword->save();

        $user = User::where('user_id', $req->user_id)->first();
        $user->password = bcrypt($req->password);
        $user->modified_datetime = now();
        $done = $user->save();

        if ($done)
        {
            return redirect()->route('index')->with('success', 'Password reset successfully');
        } else {
            return redirect()->route('index')->with('sticky_error', 'Something went wrong, Please try again later or contract admin');
        }
    }
}
