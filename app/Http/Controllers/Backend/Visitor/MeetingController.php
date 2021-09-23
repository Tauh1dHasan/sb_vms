<?php

namespace App\Http\Controllers\Backend\Visitor;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\Employee;
use App\Models\MeetingPurpose;
use Illuminate\Support\Facades\Mail;

use App\Mail\AppointmentRequest;

class MeetingController extends Controller
{
    // creating meeting into database
    public function store(Request $req)
    {
        $meeting = new Meeting;

        $user_id = session('loggedUser');

        $meeting->visitor_id = $req->visitor_id;
        $meeting->user_id = $user_id;
        $meeting->employee_id = $req->employee_id;
        $meeting->meeting_purpose_id = $req->meeting_purpose_id;
        $meeting->purpose_describe = $req->meeting_purpose_describe;
        $meeting->meeting_datetime = $req->meeting_datetime;
        $meeting->has_vehicle = $req->has_vehicle;
        $done = $meeting->save();

        $employee_mail = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                
                                ->select('meetings.*', 'visitors.first_name as vfname', 'visitors.last_name as vlname','employees.first_name as efname', 'employees.last_name as elname',  'employees.email')
                                ->where('visitors.visitor_id', '=', $req->visitor_id)
                                ->where('employees.employee_id', '=', $req->employee_id)
                                ->first();
                                // dd($employee_mail);

        

        if($done)
        {
            mail::to($employee_mail->email)->send(new AppointmentRequest($employee_mail));
            return redirect()->route('visitor.pendingaMeetings')->with('success', 'Your meeting placed successfully');
        }
        else
        {
            return redirect()->back()->with('fail', 'Sorry...! Something went wrong, Please try again');
        }
    }


    // make an appointment form
    public function create()
    {
        $user_id = session('loggedUser');

        $purpose = DB::table('meeting_purposes')->get();

        $visitor = DB::table('visitors')
                    ->select('visitors.*')
                    ->where('visitors.user_id', '=', $user_id)
                    ->first();

                    // dd($visitor);

        return view('backend.pages.visitor.make_appointment', compact('purpose', 'visitor'));
    }

    // Show all appointment status
    public function index(Request $req)
    {
        $user_id = session('loggedUser');
        $meetings = DB::table('meetings')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                    ->where('meetings.user_id', '=', $user_id)
                    ->get();

        return view('backend.pages.visitor.all_appointments', compact('meetings'));
    }

    // autocomplete employee
    public function search_employees(Request $request)
    {
        // if($request->get('query'))
        // {
        //     $query = $request->get('query');

        //     $data = DB::table('employees')
        //             ->join('departments', 'departments.dept_id', '=', 'employees.dept_id')
        //             ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
        //             ->select('employee_id', 'first_name', 'last_name', 'departments.department_name as department', 'designations.designation as designation', 'mobile_no')
        //             ->where('first_name', 'LIKE', "%{$query}%")
        //             ->orWhere('mobile_no', 'LIKE', "%{$query}%")
        //             ->get();

        //     $output = '<ul class="form-control" style="list-style: none; background: #C7E6E4; height: 100%;">';

        //     foreach($data as $row)
        //     {
        //         $output = '<option style="cursor: pointer; color: #009688; border-bottom: 2px solid white; padding: 5px;" value="'.$row->employee_id.'">'.$row->first_name.' '.$row->last_name.' ('.$row->designation.', '.$row->department.')</option>';
        //     }

        //     // $output .= '</ul>';

        //     echo $output;
            
        //     return $data;
        // }

        $data = [];

        if($request->has('q')){

            $query = $request->q;

            $data = DB::table('employees')
                    ->join('departments', 'departments.dept_id', '=', 'employees.dept_id')
                    ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                    ->select('employee_id', 'first_name', 'last_name','availability', 'employees.status', 'departments.department_name as department', 'designations.designation as designation', 'mobile_no')
                    ->where('availability', '=', 1)
                    ->where('employees.status', '=', 1)
                    ->where(function($item)use($query){
                        $item->where('first_name', 'LIKE', "%{$query}%")
                              ->orWhere('mobile_no', 'LIKE', "%{$query}%");
                    })->get();

                    

            // $users = User::where('active','1')
            //     ->where(function($query) {
            //     $query->where('email','jdoe@example.com')
            //                 ->orwhere('email','johndoe@example.com');
            //             })->get();

            // $data = DB::table('employees')
            //     ->join('departments', 'departments.dept_id', '=', 'employees.dept_id')
            //     ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
            //     ->select('employee_id', 'first_name', 'last_name', 'departments.department_name as department', 'designations.designation as designation', 'mobile_no')
            //     ->where('first_name', 'LIKE', "%{$query}%")
            //     ->orWhere('mobile_no', 'LIKE', "%{$query}%")
            //     ->get();
        }
        return response()->json($data);
    }

    // Show all approved meetings of a user
    public function approved(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');      
        
        $meetings = DB::table('meetings')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                    ->where('meetings.user_id', '=', $user_id)
                    ->where('meetings.meeting_status', '=', '1')
                    ->orderBy('meeting_id' , 'desc')
                    ->get();

        return view('backend.pages.visitor.approved_meetings', compact('meetings'));
    }

    // Show all pending meetings of a user
    public function pending(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');

        $meetings = DB::table('meetings')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                    ->where('meetings.user_id', '=', $user_id)
                    ->where('meetings.meeting_status', '=', '0')
                    ->orderBy('meeting_id' , 'desc')
                    ->get();

        return view('backend.pages.visitor.pending_meetings', compact('meetings'));
    }

    // Show all rejected meetings of a user
    public function rejected(Request $req)
    {
        // User session user_id
        $user_id = session('loggedUser');

        $meetings = DB::table('meetings')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                    ->where('meetings.user_id', '=', $user_id)
                    ->where('meetings.meeting_status', '=', '2')
                    ->orderBy('meeting_id' , 'desc')
                    ->get();

        return view('backend.pages.visitor.rejected_meetings', compact('meetings'));
    }

    // Meeting cancel functionalities for visitor
    public function cancel_meeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::find($meeting_id);
        $meeting->cancel_reason = $request->cancel_reason;
        $meeting->meeting_status = 4;
        $done = $meeting->save();

        if($done){
            return redirect(route('visitor.all_meetings'))->with('success', 'Your appointment is canceled');
        }else{
            return redirect(route('visitor.all_meetings'))->with('fail', 'Your appointment is canceled');
        }
    }

    // Visitor pass to get into meeting
    public function visitor_pass(Request $req)
    {
        $meeting_id = $req->meeting_id;
        $user_id = $req->user_id;

        return view('backend.pages.visitor.visitor_pass')->with('meeting_id', $meeting_id);
    }

    // Gate pass function for receptionist
    public function gate_pass()
    {
        return "working";
    }

    // getting host name with auto suggestion
    public function getHost(Request $req)
    {
        $data = Meeting::select('first_name', 'department', 'designation')->where('first_name','LIKE', '%{$req->value}%')->get();
        dd($data);
        return response()->json($data);
    }

    // Visitors all appointments custom reporting
    public function custom_report(Request $request)
    {
        $user_id = session('loggedUser');
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $meetings = DB::table('meetings')
                    ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                    ->select('meetings.*', 'meeting_purposes.purpose_name as purpose_name')
                    ->where('meetings.user_id', '=', $user_id)
                    ->where('meeting_datetime', '>=', $from_date)
                    ->where('meeting_datetime', '<=', $to_date)
                    ->orderBy('meeting_id' , 'desc')
                    ->get();
        
        return view('backend.pages.visitor.custom_report', compact('meetings'));
    }
    
}
