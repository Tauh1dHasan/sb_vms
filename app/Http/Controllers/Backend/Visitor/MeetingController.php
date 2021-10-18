<?php

namespace App\Http\Controllers\Backend\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

/* included models */
use App\Models\Meeting;
use App\Models\MeetingLog;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\MeetingPurpose;

/* included mails */
use App\Mail\AppointmentRequest;
use App\Mail\VisitorMeetingCancel;

class MeetingController extends Controller
{
    /**
     * Display make an appointment form.
     */
    public function create()
    {
        $user_id = session('loggedUser');

        $purpose = MeetingPurpose::where('purpose_status', '=', 1)->get();

        $visitor = Visitor::where('visitors.user_id', '=', $user_id)
                            ->first();

        return view('backend.pages.visitor.make_appointment', compact('purpose', 'visitor'));
    }


    /**
     * Store new meeting information from visitor.
     */
    public function store(Request $req)
    {
        // insert appointment data into meetings table
        $meeting = new Meeting;
        $user_id = session('loggedUser');
        $meeting->visitor_id = $req->visitor_id;
        $meeting->user_id = $user_id;
        $meeting->employee_id = $req->employee_id;
        $meeting->meeting_purpose_id = $req->meeting_purpose_id;
        $meeting->purpose_describe = $req->meeting_purpose_describe;
        $meeting->meeting_datetime = $req->meeting_datetime;
        $meeting->attendees_no = $req->attendees_no;
        $meeting->entry_user_id = session('loggedUser');
        $meeting->entry_datetime = now();
        $meeting->meeting_status = 0;
        $meeting->has_vehicle = $req->has_vehicle;
        $meetingDone = $meeting->save();

        // Store appointment data into meeting_logs table
        $meeting_id = Meeting::where('user_id', session('loggedUser'))->orderBy('meeting_id', 'desc')->first();
        $meeting_id = $meeting_id->meeting_id;
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting_id;
        $meetingLog->user_id = $user_id;
        $meetingLog->visitor_id = $req->visitor_id;
        $meetingLog->employee_id = $req->employee_id;
        $meetingLog->meeting_purpose_id = $req->meeting_purpose_id;
        $meetingLog->purpose_describe = $req->meeting_purpose_describe;
        $meetingLog->meeting_datetime = $req->meeting_datetime;
        $meetingLog->attendees_no = $req->attendees_no;
        $meetingLog->meeting_status = 0;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->has_vehicle = $req->has_vehicle;
        $meetingLog->description = "Appointment placed from visitor panel";
        $meetingLog->log_type = 6;
        $meetingLog->status = 1;
        $meetingLogDone = $meetingLog->save();

        // Email notification to host
        $employee_mail = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                ->select('meetings.*', 'visitors.first_name as vfname', 'visitors.last_name as vlname','employees.first_name as efname', 'employees.last_name as elname',  'employees.email')
                                ->where('visitors.visitor_id', '=', $req->visitor_id)
                                ->where('employees.employee_id', '=', $req->employee_id)
                                ->first();

        if ($meetingDone && $meetingLogDone) {
            mail::to($employee_mail->email)->send(new AppointmentRequest($employee_mail));
            return redirect()->route('visitor.pendingaMeetings')->with('success', 'Your meeting placed successfully');
        } else {
            return redirect()->back()->with('fail', 'Sorry...! Something went wrong, Please try again');
        }
    }


    /**
     * Display all-Appointment status.
     */
    public function index(Request $req)
    {
        $user_id = session('loggedUser');

        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                    ->where('meetings.user_id', '=', $user_id)
                    ->get();

        return view('backend.pages.visitor.all_appointments', compact('meetings'));
    }

    /**
     * Display employee information AJAX.
     */
    public function searchEmployees(Request $request)
    {

        $data = [];

        if($request->has('q')){

            $query = $request->q;

            $data = Employee::join('departments', 'departments.dept_id', '=', 'employees.dept_id')
                            ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                            ->select('employee_id', 'first_name', 'last_name','availability', 'employees.status', 'departments.department_name as department', 'designations.designation as designation', 'mobile_no')
                            ->where('availability', '=', 1)
                            ->where('employees.status', '=', 1)
                            ->where(function($item)use($query){
                                $item->where('first_name', 'LIKE', "%{$query}%")
                                    ->orWhere('mobile_no', 'LIKE', "%{$query}%");
                            })->get();

        }
        return response()->json($data);
    }

    /**
     * Display all approved meetings.
     */
    public function approved(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');      
        
        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->where('meetings.user_id', '=', $user_id)
                            ->where('meetings.meeting_status', '=', '1')
                            ->orderBy('meeting_id' , 'desc')
                            ->get();

        return view('backend.pages.visitor.approved_meetings', compact('meetings'));
    }

    /**
     * Display all pending meetings.
     */
    public function pending(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');

        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->where('meetings.user_id', '=', $user_id)
                            ->where('meetings.meeting_status', '=', '0')
                            ->orderBy('meeting_id', 'desc')
                            ->get();

        return view('backend.pages.visitor.pending_meetings', compact('meetings'));
    }

    /**
     * Display all reschedule meetings.
     */
    public function reschedule()
    {
        // User session user_id
        $user_id = session('loggedUser');

        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->where('meetings.user_id', '=', $user_id)
                            ->where('meetings.meeting_status', '=', '3')
                            ->orderBy('meeting_id', 'desc')
                            ->get();

        return view('backend.pages.visitor.reschedule_meetings', compact('meetings'));
    }

    /**
     * Display all declined meetings.
     */
    public function rejected(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');

        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->where('meetings.user_id', '=', $user_id)
                            ->where('meetings.meeting_status', '=', '2')
                            ->orderBy('meeting_id' , 'desc')
                            ->get();

        return view('backend.pages.visitor.rejected_meetings', compact('meetings'));
    }

    /**
     * Meeting cancel method.
     */
    public function cancelMeeting(Request $request)
    {
        // Update meeting status into meetings table
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->modified_user_id = session('loggedUser');
        $meeting->modified_datetime = now();
        $meeting->cancel_reason = $request->cancel_reason;
        $meeting->meeting_status = 4;
        $done = $meeting->save();
        
        // keep cancelation log into meeting_logs table
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting_id;
        $meetingLog->user_id = $meeting->user_id;
        $meetingLog->visitor_id = $meeting->visitor_id;
        $meetingLog->employee_id = $meeting->employee_id;
        $meetingLog->meeting_purpose_id = $meeting->meeting_purpose_id;
        $meetingLog->purpose_describe = $meeting->purpose_describe;
        $meetingLog->meeting_datetime = $meeting->meeting_datetime;
        $meetingLog->cancel_reason = $request->cancel_reason;
        $meetingLog->meeting_status = 4;
        $meetingLog->has_vehicle = $meeting->has_vehicle;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->description = "Appointment canceled by visitor";
        $meetingLog->log_type = 4;
        $meetingLog->status = 1;
        $meetingLog->save();

        $visitor_id = $meeting->visitor_id;
        $employee_id = $meeting->employee_id;
        $visitor_meeting_cancel_email = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                        ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                        ->select('meetings.meeting_datetime', 'meetings.cancel_reason', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no', 'employees.first_name as efname', 'employees.last_name as elname',  'employees.email')
                                        ->where('visitors.visitor_id', '=', $visitor_id)
                                        ->where('employees.employee_id', '=', $employee_id)
                                        ->first();


        if($done){
            mail::to($visitor_meeting_cancel_email->email)->send(new VisitorMeetingCancel($visitor_meeting_cancel_email));
            return redirect(route('visitor.all_meetings'))->with('success', 'Your appointment is canceled');
        }else{
            return redirect(route('visitor.all_meetings'))->with('fail', 'Your appointment is canceled');
        }
    }

    /**
     * Visitor pass.
     */
    public function visitorPass($meeting_id)
    {
        $meeting = Meeting::where('meeting_id', $meeting_id)
                            ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->select('meeting_id', 'meeting_datetime', 'employees.first_name as efname', 'employees.last_name as elname', 'visitors.first_name as vfname', 'visitors.last_name as vlname',)
                            ->first();
        return view('backend.pages.visitor.visitor_pass', compact('meeting'));
    }

    /**
     * Meeting gate pass.
     */
    public function gate_pass($meeting_id)
    {
        $meeting = Meeting::where('meeting_id', $meeting_id)->first();

        $meetingInfo = "Appointment ID: {{$meeting->meeting_id}} <br> Visitor ID: {{$meeting->visitor_id}} <br> Employee ID: {{$meeting->employee_id}} <br> Appointment Status: {{$meeting->meeting_status}}";
        
        return $meetingInfo;
    }

    /**
     * Get host name, auto-suggestion.
     */
    public function getHost(Request $req)
    {
        $data = Meeting::select('first_name', 'department', 'designation')->where('first_name','LIKE', '%{$req->value}%')->get();

        return response()->json($data);
    }

    /**
     * Display meeting info by custom date range.
     */
    public function customReport(Request $request)
    {
        $user_id = session('loggedUser');
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $meetings = Meeting::join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->select('meetings.*', 'meeting_purposes.purpose_name as purpose_name')
                            ->where('meetings.user_id', '=', $user_id)
                            ->where('meeting_datetime', '>=', $from_date)
                            ->where('meeting_datetime', '<=', $to_date)
                            ->orderBy('meeting_id' , 'desc')
                            ->get();
        
        return view('backend.pages.visitor.custom_report', compact('meetings'));
    }
    
}
