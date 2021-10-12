<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* included models */
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Meeting;
use App\Models\MeetingPurpose;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::where('visitor_status', 1)->get();

        $employees = Employee::where('status', 1)->get();

        $departments = Department::where('status', 1)->get();

        $appointments = Meeting::with('visitor', 'employee', 'meeting_purpose')->get();

        return view('backend.pages.admin.appointment.index', compact('visitors', 'employees', 'appointments', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * approve a meeting.
     */
    public function approve($meeting_id)
    {
        $appointment = Meeting::where('meeting_id', $meeting_id)
                        ->update(['meeting_status' => 1]);

        Session()->flash('success', 'Appointment Approved Successfully.');
        return redirect()->back();
    }

    /**
     * decline a meeting.
     */
    public function decline($meeting_id)
    {
        $appointment = Meeting::where('meeting_id', $meeting_id)
                        ->update(['meeting_status' => 2]);

        Session()->flash('success', 'Appointment Decline Successfully.');
        return redirect()->back();
    }

    /**
     * reschedule a meeting.
     */
    public function reschedule(Request $request, $meeting_id)
    {
        $appointment = Meeting::where('meeting_id', $meeting_id)
                            ->update([
                                'meeting_datetime' => $request->meeting_datetime,
                                'meeting_status' => 3
                            ]);

        Session()->flash('success', 'Appointment Rescheduled Successfully.');
        return redirect()->back();
    }

    /**
     * reschedule a meeting.
     */
    public function search(Request $request)
    {
        $visitor = $request->visitor_id;
        $employee = $request->employee_id;
        $from_date = $request->from_date  ? $request->from_date: date('Y-m-d');
        $to_date = $request->to_date ? $request->to_date: date('Y-m-d');

        $visitors = Visitor::where('visitor_status', 1)->get();

        $employees = Employee::where('status', 1)->get();

        $departments = Department::where('status', 1)->get();
        
        $appointments =  Meeting::with('visitor', 'employee')
                                ->whereBetween('meeting_datetime', [$from_date. " 00:00:00", $to_date." 23:59:59"])
                                ->where(function($q) use ($employee, $visitor){
                                    if($employee)
                                    {
                                        $q->where('employee_id', $employee);
                                    }
                                    if($visitor)
                                    {
                                        $q->where('visitor_id', $visitor);
                                    }
                                })->get();
        
        return view('backend.pages.admin.appointment.search', compact('visitors', 'employees', 'departments', 'appointments', 'visitor', 'employee', 'from_date', 'to_date'));
    }

    // Display all pending appointments
    public function showPending()
    {
        $meetings = Meeting::where('meeting_status', 0)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.pending', compact('meetings'));
    }

    // Display all approved appointments
    public function showApproved()
    {
        $meetings = Meeting::where('meeting_status', 1)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.approved', compact('meetings'));
    }

    // Display all declined appointments
    public function showDeclined()
    {
        $meetings = Meeting::where('meeting_status', 2)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.declined', compact('meetings'));
    }

    // Show all re-scheduled appointments
    public function showRescheduled()
    {
        $meetings = Meeting::where('meeting_status', 3)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.rescheduled', compact('meetings'));
    }

    // Show all canceled appointments
    public function showCanceled()
    {
        $meetings = Meeting::where('meeting_status', 4)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.canceled', compact('meetings'));
    }

    // Show all ongoing appointments
    public function showOngoing()
    {
        $meetings = Meeting::where('meeting_status', 11)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.ongoing', compact('meetings'));
    }

    // Show today's appointments
    public function showTodays()
    {
        // current date
        $currentDate = date('Y-m-d');
        $meetings = Meeting::whereBetween('meeting_datetime', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meeting_id', 'meeting_datetime', 'meeting_status', 'purpose_name', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'employees.first_name as efname', 'employees.last_name as elname')
                            ->get();
        return view('backend.pages.admin.appointment.todays', compact('meetings'));
    }
}
