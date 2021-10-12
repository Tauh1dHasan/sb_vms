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

class VisitorManageController extends Controller
{
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
}
