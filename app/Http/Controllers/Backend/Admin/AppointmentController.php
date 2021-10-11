<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* included models */
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Meeting;

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
        $visitors = Visitor::where('visitor_status', 1)->get();

        $employees = Employee::where('status', 1)->get();

        $appointments = Meeting::latest()
                                ->join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                ->where('')
                                ->get();

        return view('backend.pages.admin.appointment.search', compact('visitors', 'employees', 'appointments'));
    }
}
