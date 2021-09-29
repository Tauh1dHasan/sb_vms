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
        $total_meeting = Meeting::where('user_id', '=', $user_id)->get();
        $meeting_count = $total_meeting->count();

        $y_date = date('Y-m-d',strtotime("-1 days"));
        $t_date = date('Y-m-d',strtotime("+1 days"));
        // Total number of today's appointments
        $today_meeting = Meeting::where('user_id', '=', $user_id)
                                ->where('meeting_datetime', '>', $y_date)
                                ->where('meeting_datetime', '<', $t_date)
                                ->get();
        $today_meeting_count = $today_meeting->count();

        // Total pending appointments
        $pending_meetings = Meeting::where('user_id', '=', $user_id)
                                    ->where('meeting_status', '=', 0)
                                    ->get();
        $pending_meeting_count = $pending_meetings->count();

        // Total rejected appointments
        $rejected_meeting = Meeting::where('user_id', '=', $user_id)
                                    ->where('meeting_status', '=', 2)
                                    ->get();
        $rejected_meeting_count = $rejected_meeting->count();

        return view('backend.pages.visitor.index', compact('meeting_count', 'today_meeting_count', 'pending_meeting_count', 'rejected_meeting_count'));
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

        if ($visitor->gender == '1') {
            $gender = 'Male';
        } elseif ($visitor->gender == '2') {
            $gender = 'Female';
        } else {
            $gender = 'Not given';
        }

        return view('backend.pages.visitor.profile', compact('visitor', 'gender'));
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
        // current loged in user ID
        $user_id = $req->user_id;
        // Update visitor table old row status
        $visitor_old_data_query = Visitor::where('user_id', '=', $user_id)->where('visitor_status', '=', '1')->first();
        $visitor_old_data_query->visitor_status = '3';
        $visitor_old_data_query->save();
        // get required old data
        $slug = $visitor_old_data_query->slug;
        $gender = $visitor_old_data_query->gender;
        $dob = $visitor_old_data_query->dob;
        $old_profile_photo = $visitor_old_data_query->profile_photo;

        // Insert new row with updated data
        $visitor = new Visitor;
        $visitor->user_id = $user_id;
        $visitor->visitor_type = $req->visitor_type;
        $visitor->first_name = $req->fname;
        $visitor->last_name = $req->lname;
        $visitor->slug = $slug;
        $visitor->organization = $req->organization;
        $visitor->designation = $req->designation;
        $visitor->gender = $gender;
        $visitor->dob = $dob;
        $visitor->mobile_no = $req->mobile_no;
        $visitor->email = $req->email;
        $visitor->address = $req->address;
        $visitor->nid_no = $req->nid_no;
        $visitor->passport_no = $req->passport_no;
        $visitor->driving_license_no = $req->driving_license_no;
        $visitor->modified_user_id = $user_id;
        $visitor->modified_datetime = date('Y-m-d H:i:s');
        $visitor->visitor_status = '1';
        


        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($new_photo)->save($location);
            $visitor->profile_photo = $imgName;
            File::delete(public_path() . '/backend/img/visitors/'. $old_profile_photo);
        } else {
            $visitor->profile_photo = $old_profile_photo;
        }

        $visitor_table = $visitor->save();

        // User table data update
        $user = User::find($user_id);
        $user->mobile_no = $req->mobile_no;
        $user->email = $req->email;
        $user_table = $user->save();
         
        
        if ($visitor_table && $user_table) {
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

        $old_password = User::where('user_id', '=', $user_id)
                        ->first();
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
