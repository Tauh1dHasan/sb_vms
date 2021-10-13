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
use App\Models\MeetingLog;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MeetingPurpose;
use App\Models\HostLog;

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

        $currentDate = date('Y-m-d');
        // Today's appointment count
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->whereBetween('meeting_datetime', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
                            ->where('meetings.employee_id', '=', $employee_id)
                            ->get();
        $today_appointment = $meetings->count(); 

        // Total approved appointment count
        $pending = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                        ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                        ->where('meetings.meeting_datetime', '>', $currentDate)
                        ->where('meetings.meeting_status', '=', 1)
                        ->where('meetings.employee_id', '=', $employee_id)
                        ->get();
        $approved_appointment = $pending->count();

        // Total pending appointment count
        $pending = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                        ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                        ->where('meetings.meeting_datetime', '>', $currentDate)
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

    // Change availability status
    public function availabilityStatus(Request $req)
    {
        $employee = Employee::where('employee_id', '=', $req->employee_id)
                            ->first();
        if ($employee->availability == 0)
        {
            $employee->availability = '1';
            $employee->save();
            return redirect()->route('employee.index')->with('success', 'Status changed to Available successfully');
        } elseif ($employee->availability == 1)
        {
            $employee->availability = '0';
            $employee->save();
            return redirect()->route('employee.index')->with('success', 'Status changed to Unavailable successfully');
        } else {
            return redirect()->route('employee.index')->with('fail', 'Something went wrong, We are unable to change your availability status');
        }

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

        $currentDate = date('Y-m-d');
        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->whereBetween('meeting_datetime', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
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
        $currentDate = date('Y-m-d');
        
        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.meeting_datetime', '>', $currentDate)
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
    public function declineMeeting($meeting_id)
    {
        
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 2;
        $done = $meeting->save();

        // insert data into meeting_logs table
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting->meeting_id;
        $meetingLog->user_id = session('loggedUser');
        $meetingLog->visitor_id = $meeting->visitor_id;
        $meetingLog->employee_id = $meeting->employee_id;
        $meetingLog->meeting_purpose_id = $meeting->meeting_purpose_id;
        $meetingLog->purpose_describe = $meeting->purpose_describe;
        $meetingLog->meeting_datetime = $meeting->meeting_datetime;
        $meetingLog->meeting_start_time = $meeting->meeting_start_time;
        $meetingLog->meeting_end_time = $meeting->meeting_end_time;
        $meetingLog->cancel_reason = $meeting->cancel_reason;
        $meetingLog->meeting_status = '2';
        $meetingLog->checkin_status = $meeting->checkin_status;
        $meetingLog->has_vehicle = $meeting->has_vehicle;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->description = "Appointment declined by host";
        $meetingLog->log_type = '2';
        $meetingLog->status = '1';
        $meetingLog->save();

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
    public function approveMeeting($meeting_id)
    {
        
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 1;
        $done = $meeting->save();

        // insert data into meeting_logs table
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting->meeting_id;
        $meetingLog->user_id = session('loggedUser');
        $meetingLog->visitor_id = $meeting->visitor_id;
        $meetingLog->employee_id = $meeting->employee_id;
        $meetingLog->meeting_purpose_id = $meeting->meeting_purpose_id;
        $meetingLog->purpose_describe = $meeting->purpose_describe;
        $meetingLog->meeting_datetime = $meeting->meeting_datetime;
        $meetingLog->meeting_start_time = $meeting->meeting_start_time;
        $meetingLog->meeting_end_time = $meeting->meeting_end_time;
        $meetingLog->cancel_reason = $meeting->cancel_reason;
        $meetingLog->meeting_status = '1';
        $meetingLog->checkin_status = $meeting->checkin_status;
        $meetingLog->has_vehicle = $meeting->has_vehicle;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->description = "Appointment approved by host";
        $meetingLog->log_type = '1';
        $meetingLog->status = '1';
        $meetingLog->save();

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

        // insert data into meeting_logs table
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting->meeting_id;
        $meetingLog->user_id = session('loggedUser');
        $meetingLog->visitor_id = $meeting->visitor_id;
        $meetingLog->employee_id = $meeting->employee_id;
        $meetingLog->meeting_purpose_id = $meeting->meeting_purpose_id;
        $meetingLog->purpose_describe = $meeting->purpose_describe;
        $meetingLog->meeting_datetime = $request->meeting_datetime;
        $meetingLog->meeting_start_time = $meeting->meeting_start_time;
        $meetingLog->meeting_end_time = $meeting->meeting_end_time;
        $meetingLog->cancel_reason = $meeting->cancel_reason;
        $meetingLog->meeting_status = '3';
        $meetingLog->checkin_status = $meeting->checkin_status;
        $meetingLog->has_vehicle = $meeting->has_vehicle;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->description = "Appointment Re-scheduled by host";
        $meetingLog->log_type = '3';
        $meetingLog->status = '1';
        $meetingLog->save();

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

        return view('backend.pages.employee.profile', compact('employee'));
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

        $departments = Department::where('status', '=', 1)
                                ->orderBy('dept_id', 'asc')
                                ->get();
        $designations = Designation::where('status', '=', 1)
                                    ->orderBy('designation_id', 'asc')
                                    ->get();

        return view('backend.pages.employee.edit_profile', compact('employee', 'departments', 'designations'));
    }

    /**
     * Host profile update method.
     */
    public function updateProfile(Request $req)
    {   
        // get employee old data
        $user_id = session('loggedUser');
        $employee_old_data_query = Employee::where('user_id', '=', $user_id)->first();
        $employee_id = $employee_old_data_query->employee_id;
        $user_type_id = $employee_old_data_query->user_type_id;
        $employee_old_photo = $employee_old_data_query->photo;

        // insert new/updated data into host_logs table
        $hostLog = new HostLog;
        $hostLog->employee_id = $employee_id;
        $hostLog->user_id = $user_id;
        $hostLog->user_type_id = $user_type_id;
        $hostLog->first_name = $req->first_name;
        $hostLog->last_name = $req->last_name;
        $hostLog->gender = $req->gender;
        $hostLog->dob = $req->dob;
        $hostLog->eid_no = $req->eid_no;
        $hostLog->dept_id = $req->dept_id;
        $hostLog->designation_id = $req->designation_id;
        $hostLog->mobile_no = $req->mobile_no;
        $hostLog->email = $req->email;
        $hostLog->address = $req->address;
        $hostLog->nid_no = $req->nid_no;
        $hostLog->passport_no = $req->passport_no;
        $hostLog->driving_license_no = $req->driving_license_no;
        $hostLog->start_hour = $req->start_hour;
        $hostLog->end_hour = $req->end_hour;
        $hostLog->building_no = $req->building_no;
        $hostLog->gate_no = $req->gate_no;
        $hostLog->floor_no = $req->floor_no;
        $hostLog->elevator_no = $req->elevator_no;
        $hostLog->room_no = $req->room_no;
        $hostLog->entry_user_id = $user_id;
        $hostLog->entry_datetime = now();
        $hostLog->description = "Host profile update request";
        $hostLog->log_type = 2;
        $hostLog->status = 1;

        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($new_photo)->save($location);
            $hostLog->photo = $imgName;
        } else {
            $hostLog->photo = $employee_old_photo;
        }

        $done = $hostLog->save();

        if ($done) 
        {
            return redirect(route('employee.index'))->with('success', 'Profile update request send to admin...');
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
