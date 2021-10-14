<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

// include models
use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorLog;
use App\Models\VisitorType;

/* included mails */
use App\Mail\RegisterMail;

class VisitorManageController extends Controller
{
    /**
     * Visitor information validation
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'organization' => 'required|max:255',
            'mobile_no' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'profile_photo' => 'mimes:jpeg,png,jpg|max:2048',
            '_answer'=>'required|simple_captcha',
        ]);
    }

    //Display all visitor list in admin panel
    public function index()
    {
        $visitors = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')->get();
        return view('backend.pages.admin.visitor.index', compact('visitors'));
    }

    // Show visitor profile from admin panel
    public function show($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', $visitor_id)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->first();
        return view('backend.pages.admin.visitor.profile', compact('visitor'));
    }

    // Edit visitor profile from admin panel
    public function edit($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', $visitor_id)
                          ->join('users', 'visitors.user_id', '=', 'users.user_id')
                          ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                          ->first();
        $visitor_type = VisitorType::where('visitor_type_status', 1)->get();

        return view('backend.pages.admin.visitor.editProfile', compact('visitor', 'visitor_type'));
    }

    // Visitor profile update from admin panel
    public function updateProfile(Request $req)
    {
        // send old data into visitor_logs table
        $visitor_old_data = Visitor::where('visitor_id', $req->visitor_id)->first();
        $visitorLog = new VisitorLog;
        $visitorLog->visitor_id = $visitor_old_data->visitor_id;
        $visitorLog->user_id = $visitor_old_data->user_id;
        $visitorLog->visitor_type = $visitor_old_data->visitor_type;
        $visitorLog->first_name = $visitor_old_data->first_name;
        $visitorLog->last_name = $visitor_old_data->last_name;
        $visitorLog->organization = $visitor_old_data->organization;
        $visitorLog->designation = $visitor_old_data->designation;
        $visitorLog->gender = $visitor_old_data->gender;
        $visitorLog->dob = $visitor_old_data->dob;
        $visitorLog->mobile_no = $visitor_old_data->mobile_no;
        $visitorLog->email = $visitor_old_data->email;
        $visitorLog->address = $visitor_old_data->address;
        $visitorLog->profile_photo = $visitor_old_data->profile_photo;
        $visitorLog->nid_no = $visitor_old_data->nid_no;
        $visitorLog->passport_no = $visitor_old_data->passport_no;
        $visitorLog->driving_license_no = $visitor_old_data->driving_license_no;
        $visitorLog->entry_user_id = session('loggedUser');
        $visitorLog->entry_datetime = now();
        $visitorLog->description = "Visitor previous profile data";
        $visitorLog->log_type = 2;
        $visitorLog->status = 1;
        $visitorLogDone = $visitorLog->save();

        // update visitors table with new data
        $visitor = Visitor::where('visitor_id', $req->visitor_id)->first();
        $visitor->visitor_type = $req->visitor_type;
        $visitor->first_name = $req->first_name;
        $visitor->last_name = $req->last_name;
        $visitor->organization = $req->organization;
        $visitor->designation = $req->designation;
        $visitor->gender = $req->gender;
        $visitor->dob = $req->dob;
        $visitor->mobile_no = $req->mobile_no;
        $visitor->email = $req->email;
        $visitor->address = $req->address;
        $visitor->nid_no = $req->nid_no;
        $visitor->passport_no = $req->passport_no;
        $visitor->driving_license_no = $req->driving_license_no;
        $visitor->modified_user_id = session('loggedUser');
        $visitor->modified_datetime = now();
        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'visitor'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($new_photo)->save($location);
            $visitor->profile_photo = $imgName;
        } else {
            $visitor->profile_photo = $visitor_old_data->profile_photo;
        }
        $visitorDone = $visitor->save();

        // Update users table mobile_no and email
        $user = User::where('user_id', $req->user_id)->first();
        $user->mobile_no = $req->mobile_no;
        $user->email = $req->email;
        $userDone = $user->save();


        if ($visitorLogDone && $visitorDone && $userDone) {
            return redirect(route('admin.visitor.show', $req->visitor_id))->with('success', 'Profile successfully updated.');
        } else {
            return redirect(route('admin.visitor.show', $req->visitor_id))->with('sticky_error', 'Something went wrong, Please try agrain.');
        }
    }

    // Approve visitor method
    public function approve($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', $visitor_id)->first();
        $visitor->visitor_status = 1;
        $visitorDone = $visitor->save();

        $user = User::where('user_id', $visitor->user_id)->first();
        $user->is_approved = 1;
        $userDone = $user->save();

        if ($visitorDone && $userDone)
        {
            return redirect()->route('admin.visitor.index')->with('success', 'Account approved successfully');
        } else {
            return redirect()->route('admin.visitor.index')->with('sticky-fail', 'Something went wrong, Please try again...!!');
        }
    }

    // Block visitor method
    public function block($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', $visitor_id)->first();
        $visitor->visitor_status = 2;
        $visitorDone = $visitor->save();

        $user = User::where('user_id', $visitor->user_id)->first();
        $user->is_approved = 2;
        $userDone = $user->save();

        if ($visitorDone && $userDone)
        {
            return redirect()->route('admin.visitor.index')->with('success', 'Account Blocked successfully');
        } else {
            return redirect()->route('admin.visitor.index')->with('sticky-fail', 'Something went wrong, Please try again...!!');
        }
    }

    // Display all pending visitor
    public function pending()
    {
        $visitors = Visitor::where('visitor_status', 0)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->get();
        return view('backend.pages.admin.visitor.pending', compact('visitors'));
    }

    // Display all approved visitor
    public function approved()
    {
        $visitors = Visitor::where('visitor_status', 1)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->get();
        return view('backend.pages.admin.visitor.approved', compact('visitors'));
    }

    // Display all blocked visitor
    public function blocked()
    {
        $visitors = Visitor::where('visitor_status', 2)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->get();
        return view('backend.pages.admin.visitor.blocked', compact('visitors'));
    }

    // Create visitor account
    public function create()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();
        return view('backend.pages.admin.visitor.createVisitorAccount', compact('visitor_types'));
    }

    // Register a visitor into database
    public function visitorRegister(Request $request)
    {
        // check if mobile number or email exist in users table
        $mobileCheck = User::where('mobile_no', '=', $request->mobile_no)->first();
        $emailCheck = User::where('email', '=', $request->email)->first();

        if ($mobileCheck || $emailCheck)
        {
            return redirect()->route('admin.visitor.create')->with('sticky_error', 'Email address or Mobile number already exist');
            // dd($request);
        }
        $this->validation($request);

        
        // Login credentials into users table 
        $user = new User;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = '4';
        $user->is_approved = 1;
        $user->entry_datetime = now();
        $user->save();

        // Visitor information into visitors table
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
        $visitor->entry_user_id = session('loggedUser');
        $visitor->entry_datetime = now();
        $visitor->visitor_status = 1;
        $visitor->slug = strtolower($request->first_name.'-'.$request->last_name);
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imgName = 'visitor'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($image)->save($location);
            $visitor->profile_photo = $imgName;
        }
        $visitor->save();

        // Activation mail to visitor email
        if ($visitor->email != NULL) 
        {
            mail::to($visitor->email)->send(new RegisterMail($visitor));
        }

        // Visitor data into visitor_logs table
        $visitor_id = Visitor::orderBy('visitor_id', 'desc')->first();
        $visitorLog = new VisitorLog;
        $visitorLog->visitor_id = $visitor_id->visitor_id;
        $visitorLog->user_id = $user_id->user_id;
        $visitorLog->visitor_type = $request->visitor_type;
        $visitorLog->first_name = $request->first_name;
        $visitorLog->last_name = $request->last_name;
        $visitorLog->organization = $request->organization;
        $visitorLog->designation = $request->designation;
        $visitorLog->gender = $request->gender;
        $visitorLog->dob = $request->dob;
        $visitorLog->mobile_no = $request->mobile_no;
        $visitorLog->email = $request->email;
        $visitorLog->address = $request->address;
        $visitorLog->profile_photo = $imgName;
        $visitorLog->nid_no = $request->nid_no;
        $visitorLog->passport_no = $request->passport_no;
        $visitorLog->driving_license_no = $request->driving_license_no;
        $visitorLog->entry_user_id = session('loggedUser');
        $visitorLog->entry_datetime = now();
        $visitorLog->description = "Visitor account created form admin panel";
        $visitorLog->log_type = 1;
        $visitorLog->status = 1;
        $visitorLog->save();


        Session()->flash('success' , 'Registration Successfull with auto validation!');
        return redirect()->route('admin.visitor.index');
    }


}
