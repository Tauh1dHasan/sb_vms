<?php

namespace App\Http\Controllers\Backend\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Auth;

/* included models */
use App\Models\MeetingPurpose;
use App\Models\Meeting;
use App\Models\Visitor;
use App\Models\VisitorLog;
use App\Models\User;

class VisitorController extends Controller
{
    /**
     * Display dashboard resouces.
     */
    public function dashboard()
    {
        // Current logged in user id from session
        $user_id = session('loggedUser');

        // Total number of appointments
        $total_meeting = Meeting::where('user_id', '=', $user_id)->get()->count();

        $y_date = date('Y-m-d',strtotime("-1 days"));
        $t_date = date('Y-m-d',strtotime("+1 days"));
        // Total number of today's appointments
        $today_meeting = Meeting::where('user_id', '=', $user_id)
                                ->where('meeting_datetime', '>', $y_date)
                                ->where('meeting_datetime', '<', $t_date)
                                ->get()
                                ->count();

        // Total pending appointments
        $pending_meetings = Meeting::where('user_id', '=', $user_id)
                                    ->where('meeting_status', '=', 0)
                                    ->get()
                                    ->count();

        // Total rejected appointments
        $rejected_meeting = Meeting::where('user_id', '=', $user_id)
                                    ->where('meeting_status', '=', 2)
                                    ->get()
                                    ->count();

        return view('backend.pages.visitor.index', compact('total_meeting', 'today_meeting', 'pending_meetings', 'rejected_meeting'));
    }

    /**
     * Display visitor profile Page.
     */
    public function profile(Request $req)
    {
        $user_id = session('loggedUser');
        
        $visitor = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->where('user_id', $user_id)
                            ->where('visitors.visitor_status', '=', '1')
                            ->first();

        return view('backend.pages.visitor.profile', compact('visitor'));
    }

    /**
     * Display visitor profile edit Page.
     */
    public function edit($user_id)
    {
        $visitor = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->where('user_id', $user_id)
                            ->where('visitors.visitor_status', '=', '1')
                            ->first();

        if ($visitor->gender == '1') {
            $gender = 'Male';
        } elseif ($visitor->gender == '2') {
            $gender = 'Female';
        } else {
            $gender = 'Not given';
        }

        $visitor_type = DB::table('visitor_types')->get();

        return view('backend.pages.visitor.edit_profile', compact('visitor', 'gender', 'visitor_type'));
    }

    /**
     * Visitor profile update method
     */
    public function update(Request $req)
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
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($new_photo)->save($location);
            $visitor->profile_photo = $imgName;
        } else {
            $visitor->profile_photo = $visitor_old_data->profile_photo;
        }
        $visitorDone = $visitor->save();

        // Update users table mobile_no and email
        $user = User::where('user_id', session('loggedUser'))->first();
        $user->mobile_no = $req->mobile_no;
        $user->email = $req->email;
        $userDone = $user->save();


        if ($visitorLogDone && $visitorDone && $userDone) {
            return redirect(route('visitor.index'))->with('success', 'Profile successfully updated.');
        } else {
            return redirect(route('visitor.index'))->with('fail', 'Something went wrong, Please try agrain.');
        }
    }

    // Change password method
    public function editPassword()
    {
        return view('backend.pages.visitor.updatePassword');
    }

    // Update and store new password
    public function updatePassword(Request $req)
    {
        // loged user_id
        $user_id = session('loggedUser');

        $req->validate([
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        $old_password = User::where('user_id', '=', $user_id)->first();
        
        if (!empty($old_password))
        {
            $password = Hash::check($req->curr_password, $old_password->password);
            if ($password)
            {
                $old_password->password = bcrypt($req->password);
                $old_password->modified_datetime = date('Y-m-d H:i:s');
                $old_password->save();
                return redirect(route('visitor.index'))->with('success', 'Password changed successfully...!');
            } else {
                return redirect(route('visitor.index'))->with('fail', 'Password did not matched, Please try again...!');
            }
        } else {
            return redirect(route('visitor.index'))->with('fail', 'New Password can not be empty...!');
        }

    }
}
