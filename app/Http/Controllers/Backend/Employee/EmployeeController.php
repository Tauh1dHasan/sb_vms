<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingReschedule;
use App\Mail\ApproveMeeting;
use App\Mail\DeclineMeeting;

/* included models */
use App\Models\User;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Meeting;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MeetingPurpose;

class EmployeeController extends Controller
{
    /**
     * Display Employee Dashboard.
     */
    public function dashboard()
    {
        // Employee information
        $user_id = session('loggedUser');
        $employee = Employee::select('employee_id', 'first_name', 'last_name', 'availability')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Total appointment count
        $meeting = Meeting::where('employee_id', '=', $employee_id)->get();
        $total_appointment = $meeting->count();

        $y_date = date('Y-m-d 00:00:00',strtotime("-1 days"));
        $t_date = date('Y-m-d 00:00:00',strtotime("+1 days"));

        // Today's appointment count
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_datetime', '>', $y_date)
                            ->where('meetings.meeting_datetime', '<', $t_date)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();
        $today_appointment = $meetings->count(); 

        // Total approved appointment count
        $pending = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                        ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                        ->where('meetings.meeting_datetime', '>', $y_date)
                        ->where('meetings.meeting_status', '=', 1)
                        ->where('meetings.employee_id', '=', $employee_id)
                        ->get();
        $approved_appointment = $pending->count();

        // Total pending appointment count
        $pending = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                        ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                        ->where('meetings.meeting_datetime', '>', $y_date)
                        ->where('meetings.meeting_status', '=', 0)
                        ->where('meetings.employee_id', '=', $employee_id)
                        ->get();
        $pending_appointment = $pending->count();


        // Total rejected appointment count
        $reject = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                        ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                        ->where('meetings.meeting_status', '=', 2)
                        ->where('meetings.employee_id', '=', $employee_id)
                        ->get();
        $reject_appointment = $reject->count();

        return view('backend.pages.employee.index', compact('total_appointment', 'today_appointment', 'approved_appointment', 'pending_appointment', 'reject_appointment','employee'));
    }

    /**
     * Display All Meeting information.
     */
    public function allMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->orderBy('meeting_id', 'desc')
                            ->get();

        return view('backend.pages.employee.all_appointment', compact('meetings'));
    }

    /**
     * Display date range meeting information.
     */
    public function customMeetingSearch(Request $request)
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->where('meetings.meeting_datetime', '>', $request->from_date)
                    ->where('meetings.meeting_datetime', '<', $request->to_date)
                    ->where('meetings.employee_id', '=', $employee_id)
                    ->get();

        return view('backend.pages.employee.custom_meeting_search', compact('meetings'));
    }

    /**
     * Display current date meetings.
     */
    public function todayMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Get dates
        $y_date = date('Y-m-d',strtotime("-1 days"));
        $t_date = date('Y-m-d',strtotime("+1 days"));

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_datetime', '>', $y_date)
                            ->where('meetings.meeting_datetime', '<', $t_date)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();

        return view('backend.pages.employee.today_meeting', compact('meetings'));
    }

    /**
     * Display only ahead pending meetings.
     */
    public function pendingMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Current date
        $y_date = date('Y-m-d',strtotime("-1 days"));
        
        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_datetime', '>', $y_date)
                            ->where('meetings.meeting_status', '=', 0)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();

        return view('backend.pages.employee.pending_meeting', compact('meetings'));
    }

    /**
     * Display only all approved meetings.
     */
    public function approvedMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_status', '=', 1)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();

        return view('backend.pages.employee.approved_meeting', compact('meetings'));
    }

    /**
     * Display all declined meetings.
     */
    public function rejectedMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_status', '=', 2)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();

        return view('backend.pages.employee.rejected_meeting', compact('meetings'));
    }

    /**
     * Display all rescheduled meetings
     */
    public function rescheduledMeetings()
    {
        $user_id = session('loggedUser');

        // get employee ID 
        $employee = Employee::select('employee_id')
                            ->where('user_id', '=', $user_id)
                            ->where('status', '=', '1')
                            ->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_status', '=', 3)
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();

        return view('backend.pages.employee.rescheduled_meetings', compact('meetings'));
    }

    /**
     * Meeting decline method.
     */
    public function declineMeeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 2;
        $done = $meeting->save();

        $mail_data = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                            ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                            ->select('meetings.meeting_datetime', 'visitors.email as v_email', 'visitors.first_name as v_fname', 'visitors.last_name as v_lname', 'employees.first_name as e_fname', 'employees.last_name as e_lname')
                            ->where('meetings.meeting_id', '=', $meeting_id)
                            ->first();

        if ($done)
        {
            mail::to($mail_data->v_email)->send(new DeclineMeeting($mail_data));
            return redirect()->back()->with('success', 'Meeting Declined Successfully...');

        } else {

            return redirect()->back()->with('fail', 'Something went wrong, Please try again...');
        }

    }

    /**
     * Meeting approval method.
     */
    public function approveMeeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 1;
        $done = $meeting->save();

        $mail_data = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                            ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                            ->select('meetings.meeting_datetime', 'visitors.email as v_email', 'visitors.first_name as v_fname', 'visitors.last_name as v_lname', 'employees.first_name as e_fname', 'employees.last_name as e_lname')
                            ->where('meetings.meeting_id', '=', $meeting_id)
                            ->first();

        if ($done)
        {
            mail::to($mail_data->v_email)->send(new ApproveMeeting($mail_data));
            return redirect()->back()->with('success', 'Meeting Approved Successfully...');

        } else {

            return redirect()->back()->with('fail', 'Something went wrong, Please try again...');
        }
    }

    /**
     * Meeting Re-Schedule Method.
     */
    public function rescheduleMeeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_datetime = $request->meeting_datetime;
        $meeting->meeting_status = 3;
        $done = $meeting->save();

        $mail_data = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                            ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                            ->select('meetings.meeting_datetime', 'visitors.email as v_email', 'visitors.first_name as v_fname', 'visitors.last_name as v_lname', 'employees.first_name as e_fname', 'employees.last_name as e_lname')
                            ->where('meetings.meeting_id', '=', $meeting_id)
                            ->first();
        if ($done)
        {
            mail::to($mail_data->v_email)->send(new MeetingReschedule($mail_data));
            return redirect()->back()->with('success', 'Meeting Re-Scheduled Successfully...');

        } else {

            return redirect()->back()->with('fail', 'Something went wrong, Please try again...');
        }

    }

    /**
     * Display host profile.
     */
    public function profile()
    {
        $user_id = session('loggedUser');

        $employee = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->where('user_id', $user_id)
                    ->where('employees.status', '=', '1')
                    ->first();
        $gender = $employee->gender;

        if ($gender == 1){
            $gender = "Male";
        } elseif ($gender == 2){
            $gender = "Female";
        } else {
            $gender = "Not given";
        }

        return view('backend.pages.employee.profile', compact('employee', 'gender'));
    }

    /**
     * Display host profile update form.
     */
    public function edit($user_id)
    {
        $employee = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                            ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                            ->where('user_id', $user_id)
                            ->where('employees.status', '=', '1')
                            ->first();

        $gender = $employee->gender;

        if($gender == '1'){
            $gender_id = '1';
            $gender = "Male";
        }elseif($gender == '2'){
            $gender_id = '2';
            $gender = "Female";
        }else{
            $gender_id = '3';
            $gender = "Select";
        }

        $departments = Department::where('status', '=', 1)
                                ->orderBy('dept_id', 'asc')
                                ->get();
        $designations = Designation::where('status', '=', 1)
                                    ->orderBy('designation_id', 'asc')
                                    ->get();

        return view('backend.pages.employee.edit_profile', compact('employee', 'departments', 'designations', 'gender', 'gender_id'));
    }

    /**
     * Host profile update method.
     */
    public function updateProfile(Request $req)
    {   
        // loged user_id
        $user_id = session('loggedUser');

        // Update employee's old data info status
        $employee_old_data_query = Employee::where('user_id', '=', $user_id)->where('status', '=', '1')->first();
        $employee_old_data_query->status = '3';
        $employee_old_data_query->save();
        // get required old data
        $employee_type = $employee_old_data_query->user_type_id;
        $employee_slug = $employee_old_data_query->slug;
        $employee_gender = $employee_old_data_query->gender;
        $employee_dob = $employee_old_data_query->dob;
        $employee_dept_id = $employee_old_data_query->dept_id;
        $employee_designation_id = $employee_old_data_query->designation_id;
        $employee_old_photo = $employee_old_data_query->photo;

        $employee = new Employee;
        $employee->user_id = $user_id;
        $employee->user_type_id = $employee_type;
        $employee->first_name = $req->fname;
        $employee->last_name = $req->lname;
        $employee->slug = $employee_slug;
        $employee->gender = $employee_gender;
        $employee->dob = $employee_dob;
        $employee->eid_no = $req->eid;
        $employee->dept_id = $employee_dept_id;
        $employee->designation_id = $employee_designation_id;
        $employee->mobile_no = $req->mobile_no;
        $employee->email = $req->email;
        $employee->address = $req->address;
        $employee->nid_no = $req->nid_no;
        $employee->passport_no = $req->passport_no;
        $employee->driving_license_no = $req->driving_license_no;
        $employee->start_hour = $req->start_hour;
        $employee->end_hour = $req->end_hour;
        $employee->building_no = $req->building_no;
        $employee->gate_no = $req->gate_no;
        $employee->floor_no = $req->floor_no;
        $employee->elevator_no = $req->elevator_no;
        $employee->room_no = $req->room_no;
        $employee->entry_user_id = $user_id;
        $employee->entry_datetime = date('Y-m-d H:i:s');
        $employee->modified_user_id = $user_id;
        $employee->modified_datetime = date('Y-m-d H:i:s');
        $employee->availability = $req->availability;
        $employee->status = '1';

        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($new_photo)->save($location);
            $employee->photo = $imgName;
            File::delete(public_path() . '/backend/img/employees/'. $employee_old_photo);
        } else {
            $employee->photo = $employee_old_photo;
        }

        $employee_table = $employee->save();

        $user = User::find($user_id);
        $user->mobile_no = $req->mobile_no;
        $user->email = $req->email;
        $user_table = $user->save();

        if ($employee_table && $user_table)
        {
            return redirect(route('employee.index'))->with('success', 'Profile successfully updated.');
        } else {
            return redirect(route('employee.index'))->with('fail', 'Something went wrong, Please try agrain.');
        }
    }

    // Show employee password update form page
    public function editPassword()
    {
        return view('backend.pages.employee.updatePassword');
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
                return redirect(route('employee.index'))->with('success', 'Password changed successfully...!');
            } else {
                return redirect(route('employee.index'))->with('fail', 'Password did not matched, Please try again...!');
            }
        } else {
            return redirect(route('employee.index'))->with('fail', 'New Password can not be empty...!');
        }

    }

}
