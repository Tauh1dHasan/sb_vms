<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* included models */
use App\Models\Employee;
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
                            ->first();
        $employee_id = $employee->employee_id;

        // Total appointment count
        $meeting = Meeting::where('employee_id', '=', $employee_id)
                    ->get();
        $total_appointment = $meeting->count();

        $y_date = date('Y-m-d',strtotime("-1 days"));
        $t_date = date('Y-m-d',strtotime("+1 days"));

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
        $employee = Employee::select('employee_id')->where('user_id', '=', $user_id)->first();
        $employee_id = $employee->employee_id;

        // Select all meeting for this employee
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where('meetings.employee_id', '=', $employee_id)
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
        $employee = Employee::select('employee_id')->where('user_id', '=', $user_id)->first();
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
        $employee = Employee::select('employee_id')->where('user_id', '=', $user_id)->first();
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
     * Meeting decline method.
     */
    public function declineMeeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 2;
        $meeting->save();

        return redirect()->back();
    }

    /**
     * Meeting approval method.
     */
    public function approveMeeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->meeting_status = 1;
        $meeting->save();

        return redirect()->back();
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
        $meeting->save();

        return redirect()->back();
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
                            ->first();

        $department = Employee::where('status', '=', 1)->get();
        $designation = Designation::where('status', '=', 1)->get();

        return view('backend.pages.employee.edit_profile', compact('employee', 'department', 'designation'));
    }

    /**
     * Host profile update method.
     */
    public function updateProfile(Request $req)
    {   
        $user_id = $req->user_id;

        $employee = Employee::find($user_id);
        $employee->first_name = $req->fname;
        $employee->last_name = $req->lname;
        $employee->availability = $req->availability;
        $employee->dept_id = $req->department;
        $employee->designation_id = $req->designation;
        $employee->eid_no = $req->eid;
        $employee->email = $req->email;
        $employee->address = $req->address;
        $employee->mobile_no = $req->mobile_no;
        $employee->nid_no = $req->nid_no;
        $employee->passport_no = $req->passport_no;
        $employee->driving_license_no = $req->driving_license_no;
        $employee->start_hour = $req->start_hour;
        $employee->end_hour = $req->end_hour;
        $done = $employee->save();

        if($done){
            return redirect(route('employee.index'))->with('success', 'Profile successfully updated.');
        }else{
            return redirect(route('employee.index'))->with('fail', 'Something went wrong, Please try agrain.');
        }
    }
}
