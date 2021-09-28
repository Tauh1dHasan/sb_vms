<?php

namespace App\Http\Controllers\Backend\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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

        // Current datetime
        $curr_datetime = date('Y-m-d H:i:s');
        // Total number of today's appointments
        $today_meeting = Meeting::where('user_id', '=', $user_id)
                                ->where('meeting_datetime', '>', $curr_datetime)
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
        $user_id = $req->user_id;

        $visitor_type = $req->visitor_type;
        $first_name = $req->fname;
        $last_name = $req->lname;
        $organization = $req->organization;
        $designation = $req->designation;
        $mobile_no = $req->mobile_no;
        $email = $req->email;
        $address = $req->address;
        $nid_no = $req->nid_no;
        $passport_no = $req->passport_no;
        $driving_license_no = $req->driving_license_no;

        $old_photo = $req->old_photo;

        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($new_photo)->save($location);
            $employee->photo = $imgName;
            File::delete(public_path() . '/backend/img/employees/'. $old_photo);
        } else {
            $employee->photo = $old_photo;
        }
         
        // $visitor_table = DB::update('update visitors set visitor_type = ?, first_name = ?, last_name = ?, organization = ?, designation = ?, mobile_no = ?, email = ?, address = ?, nid_no = ?, passport_no = ?, driving_license_no = ? where user_id = ?', [$visitor_type, $first_name, $last_name,$organization, $designation, $mobile_no, $email, $address, $nid_no, $passport_no, $driving_license_no, $user_id]);

        // $user_table = DB::update('update users set username = ? WHERE user_id = ?' , [$mobile_no, $user_id]);

        if ($visitor_table && $user_table) {
            return redirect(route('visitor.index'))->with('success', 'Profile successfully updated.');
        } else {
            return redirect(route('visitor.index'))->with('fail', 'Something went wrong, Please try agrain.');
        }
    }
}
