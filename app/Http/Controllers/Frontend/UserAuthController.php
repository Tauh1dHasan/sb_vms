<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

/* included mails */
use App\Mail\RegisterMail;

/* included models */
use App\Models\User;
use App\Models\Visitor;

class UserAuthController extends Controller
{
    /**
     * Visitor registration method
     */
    public function user_registration(Request $request)
    {
        $this->validation($request);

        $user = new User;

        $user->username = $request->mobile_no;
        $user->password = bcrypt($request->password);
        $user->user_type_id = '4';
        $user->entry_datetime = now();

        $user->save();

        $user_id = User::orderBy('user_id', 'desc')->first();

        $visitor = new Visitor;

        $visitor->user_id = $user_id->user_id;
        $visitor->visitor_type = $request->visitor_type;
        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->organization = $request->organization;
        $visitor->designation = $request->designation;
        $visitor->gender = $request->gender;
        $visitor->dob = $request->dob;
        $visitor->mobile_no = $request->mobile_no;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->nid_no = $request->nid_no;
        $visitor->passport_no = $request->passport_no;
        $visitor->driving_license_no = $request->driving_license_no;
        $visitor->slug = strtolower($request->first_name.'-'.$request->last_name);
        $visitor->entry_datetime = now();

        $visitor->profile_photo = $request->profile_photo;
        
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imgName = 'visitor'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($image)->save($location);

            $visitor->profile_photo = $imgName;
        }

        $visitor->save();

        if($visitor->email != NULL){
            mail::to($visitor->email)->send(new RegisterMail($visitor));
        }

        Session()->flash('success' , 'Registration Successfull! Please check your email for verification.');
        return redirect()->route('index');
    }

    /**
     * Visitor information validation
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'organization' => 'required|max:255',
            'mobile_no' => 'required|unique:visitors|min:11',
            'password' => 'required|confirmed|min:6|max:255',
            'profile_photo' => 'mimes:jpeg,png,jpg|max:2048',
            '_answer'=>'required|simple_captcha',
        ]);
    }

    /**
     * Visitor log-in method
     */
    public function user_login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:11',
            'password' => 'required|max:255',
        ]);

        $user = User::where('username', '=', $request->username)->first();
        
        if (!empty($user)) {
            if ($user->is_approved == 1) {
                $password = Hash::check($request->password, $user->password);

                if ($password) {
                    Session::put(['loggedUser' => $user->user_id, 'loggedUserType' => $user->user_type_id]);
                    
                    if ($user->user_type_id == 1) {
                        return redirect(route('admin.index'));
                    }
                    if ($user->user_type_id == 2) {
                        return redirect(route('employee.index'));
                    }
                    if ($user->user_type_id == 3) {
                        return redirect(route('reception.index'));
                    }
                    if($user->user_type_id == 4) {
                        return redirect(route('visitor.index'));
                    }
                } else {
                    Session()->flash('sticky_error' , 'Username & Password didnot matched!');
                    return redirect()->back();
                }
            } else {
                Session()->flash('sticky_error' , 'User verification failed!');
                return redirect()->back();
            }
        } else {
            Session()->flash('sticky_error' , 'No user found by this username!');
            return redirect()->back();
        }
    }

    /**
     * Visitor Logout method
     */
    public function user_logout(Request $request) 
    {
        if (session()->has('loggedUser')) {
            Session::flush();
            return redirect('/');
        }
    }

    /**
     * Visitor email varification method
     */
    public function user_verify(User $user_id) {
        $user = User::where('user_id', $user_id->user_id)
                    ->update(['is_approved' => 1]);

        $visitor = Visitor::where('user_id', $user_id->user_id)
                            ->update(['visitor_status' => 1]);

        Session()->flash('success' , 'Email Verification Successfull! Please Login.');
        return redirect()->route('index');
    }
}
