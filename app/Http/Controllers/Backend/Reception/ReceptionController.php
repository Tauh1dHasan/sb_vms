<?php

namespace App\Http\Controllers\Backend\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

/* included mails */
use App\Mail\RegisterMail;

/* included models */
use App\Models\User;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Meeting;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MeetingPurpose;
use App\Models\VisitorType;
use App\Models\ReceptionLog;
use App\Models\VisitorLog;
use App\Models\MeetingLog;
use App\Models\VisitorPass;

/* included mails */
use App\Mail\AppointmentRequest;

class ReceptionController extends Controller
{
    /**
     * Visitor information validation
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'organization' => 'required|max:255',
            'mobile_no' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'profile_photo' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
    }

    // Reception Dashboard method
    public function dashboard()
    {
        $user_id = session('loggedUser');
        $user_name = Employee::select('first_name', 'last_name')->where('user_id', '=', $user_id)->first();

        // Total Appointment count
        $total_appopintment = Meeting::all()->count();

        $currentDate = date('Y-m-d');

        // Total number of today's appointments
        $today_meeting = Meeting::whereBetween('meeting_datetime', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
                                ->get()
                                ->count();

        // Total pending appointments
        $pending_meetings = Meeting::where('meeting_status', '=', 0)
                                    ->get()
                                    ->count();

        // Total rejected appointments
        $rejected_meeting = Meeting::where('meeting_status', '=', 2)
                                    ->get()
                                    ->count();

        return view('backend.pages.reception.index', compact('user_name', 'total_appopintment', 'today_meeting', 'pending_meetings', 'rejected_meeting'));
    }

    // Reception Display Profile method
    public function profile()
    {
        // User ID from session
        $user_id = session('loggedUser');
        
        $employee = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->where('user_id', $user_id)
                    ->where('employees.status', '=', '1')
                    ->first();

        return view('backend.pages.reception.profile', compact('employee'));
    }

    // Display reception edit profile form
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

        return view('backend.pages.reception.editProfile', compact('employee', 'departments', 'designations'));
    }

    // Update and store new profile information
    public function updateProfile(Request $req)
    {
        // get employee old data
        $user_id = session('loggedUser');
        $employee_old_data_query = Employee::where('user_id', $user_id)->first();

        // check for unique mobile, email address and previous active request
        $checkMobile = User::where('mobile_no', $req->mobile_no)->first();
        $checkEmail = User::where('email', $req->email)->first();
        $receptionLogCheck = ReceptionLog::where('employee_id', $req->employee_id)->where('log_type', '2')->first();

        if ($checkMobile->user_id != $user_id)
        {
            return redirect()->back()->with('sticky_error', 'Mobile number must be unique....');
        } elseif ($checkEmail->user_id != $user_id)
        {
            return redirect()->back()->with('sticky_error', 'Email address must be unique....');
        } elseif ($receptionLogCheck)
        {
            return redirect()->back()->with('sticky_error', 'Your previous request still pending....');
        }
        
        // insert new/updated data into reception_logs table
        $receptionlog = new ReceptionLog;
        $receptionlog->employee_id = $employee_old_data_query->employee_id;
        $receptionlog->user_id = $user_id;
        $receptionlog->user_type_id = $employee_old_data_query->user_type_id;
        $receptionlog->first_name = $req->first_name;
        $receptionlog->last_name = $req->last_name;
        $receptionlog->gender = $req->gender;
        $receptionlog->dob = $req->dob;
        $receptionlog->dept_id = $req->dept_id;
        $receptionlog->designation_id = $req->designation_id;
        $receptionlog->mobile_no = $req->mobile_no;
        $receptionlog->email = $req->email;
        $receptionlog->address = $req->address;
        $receptionlog->nid_no = $req->nid_no;
        $receptionlog->passport_no = $req->passport_no;
        $receptionlog->driving_license_no = $req->driving_license_no;
        $receptionlog->start_hour = $req->start_hour;
        $receptionlog->end_hour = $req->end_hour;
        $receptionlog->building_no = $req->building_no;
        $receptionlog->gate_no = $req->gate_no;
        $receptionlog->floor_no = $req->floor_no;
        $receptionlog->elevator_no = $req->elevator_no;
        $receptionlog->room_no = $req->room_no;
        $receptionlog->entry_user_id = $user_id;
        $receptionlog->entry_datetime = date('Y-m-d H:i:s');
        $receptionlog->description = "Reception profile update request";
        $receptionlog->log_type = 2;
        $receptionlog->status = 1;

        if ($req->hasFile('new_photo')) {
            $new_photo = $req->file('new_photo');
            $imgName = 'employee'.time().'.'.$new_photo->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($new_photo)->save($location);
            $receptionlog->photo = $imgName;
        } else {
            $receptionlog->photo = $employee_old_data_query->photo;
        }

        $done = $receptionlog->save();

        if ($done) 
        {
            return redirect(route('reception.index'))->with('success', 'Profile update request send to admin...');
        } else {
            return redirect(route('reception.index'))->with('sticky_error', 'Something went wrong, Please try agrain.');
        }

    }

    // Reception change password form display
    public function editPassword()
    {
        return view('backend.pages.reception.editPassword');
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
                return redirect(route('reception.index'))->with('success', 'Password changed successfully...!');
            } else {
                return redirect(route('reception.index'))->with('fail', 'Password did not matched, Please try again...!');
            }
        } else {
            return redirect(route('reception.index'))->with('fail', 'New Password can not be empty...!');
        }

    }

    // Display visitor list
    public function visitorList()
    {
        $visitors = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->where('visitors.visitor_status', '=', '1')
                            ->get();
        return view('backend.pages.reception.visitorList', compact('visitors'));
    }
    
    // Search visitor method
    public function searchVisitor(Request $req)
    {
        $data = $req->data;

        $visitors = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->where('visitors.visitor_status', '=', '1')
                            ->where(function($item)use($data){
                                $item->where('first_name', 'LIKE', "%{$data}%")
                                    ->orWhere('last_name', 'LIKE', "%{$data}%")
                                    ->orWhere('mobile_no', 'LIKE', "%{$data}%");
                            })->get();

        return view('backend.pages.reception.searchVisitor', compact('visitors'));
    }

    // Display meeting list
    public function meetingList()
    {
        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                           ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                           ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                           ->select('meeting_id', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no as vmobile', 'organization', 'designation', 'employees.first_name as efname', 'employees.last_name as elname', 'employees.mobile_no as emobile', 'purpose_name', 'purpose_describe', 'meeting_datetime', 'meeting_status', 'checkin_status', 'attendees_no')
                           ->get();

        return view('backend.pages.reception.meetingList', compact('meetings'));
    }

    // Display CheckedIn meeting list
    public function checkedInList()
    {
        $meetings = Meeting::where('checkin_status', 1)
                           ->join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                           ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                           ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                           ->join('visitor_pass', 'meetings.meeting_id', '=', 'visitor_pass.meeting_id')
                           ->select('meetings.meeting_id', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no as vmobile', 'organization', 'designation', 'employees.first_name as efname', 'employees.last_name as elname', 'employees.mobile_no as emobile', 'purpose_name', 'purpose_describe', 'meeting_datetime', 'meeting_status', 'checkin_status', 'card_no','visitor_photo', 'attendees_no')
                           ->get();
                           

        return view('backend.pages.reception.checkedInList', compact('meetings'));
    }

    // Search Meeting
    public function searchMeeting(Request $req)
    {
        $data = $req->data;

        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where(function($item)use($data){
                                $item->where('meetings.meeting_id', 'LIKE', "%{$data}%")
                                     ->orWhere('visitors.first_name', 'LIKE', "%{$data}%")
                                     ->orWhere('visitors.last_name', 'LIKE', "%{$data}%")
                                     ->orWhere('visitors.mobile_no', 'LIKE', "%{$data}%");
                            })
                            ->select('meeting_id', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no as vmobile', 'organization', 'designation', 'employees.first_name as efname', 'employees.last_name as elname', 'employees.mobile_no as emobile', 'purpose_name', 'purpose_describe', 'meeting_datetime', 'meeting_status', 'checkin_status')
                            ->get();
        
        return view('backend.pages.reception.searchMeeting', compact('meetings'));
    }

    // Display create visitor account form
    public function createVisitorAccount()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();
        return view('backend.pages.reception.createVisitorAccount', compact('visitor_types'));
    }

    // Register new visitor
    public function visitorRegister(Request $request)
    {
        // check if mobile number or email exist in users table
        $mobileCheck = User::where('mobile_no', '=', $request->mobile_no)->first();
        $emailCheck = User::where('email', '=', $request->email)->first();

        if ($mobileCheck || $emailCheck)
        {
            return redirect()->back()->with('sticky_error', 'Email address or Mobile number already exist');
        }
        $this->validation($request);

        
        // Login credentials into users table 
        $user = new User;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = '4';
        $user->entry_datetime = now();
        $user->save();

        // Visitor information into visitors table
        $user_id = User::orderBy('user_id', 'desc')->first();
        $visitor = new Visitor;
        $visitor->user_id = $user_id->user_id;
        $visitor->visitor_type = $request->visitor_type;
        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->organization = $request->organization;
        $visitor->designation = $request->designation;
        $visitor->gender = $request->gender;
        $visitor->dob = $request->dob;
        $visitor->mobile_no = $request->mobile_no;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->nid_no = $request->nid_no;
        $visitor->passport_no = $request->passport_no;
        $visitor->driving_license_no = $request->driving_license_no;
        $visitor->entry_user_id = session('loggedUser');
        $visitor->slug = strtolower($request->first_name.'-'.$request->last_name);
        $visitor->entry_datetime = now();
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imgName = 'visitor'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($image)->save($location);
            $visitor->profile_photo = $imgName;
        }
        $visitor->save();

        // Activation mail to visitor email
        if ($request->email != NULL) 
        {
            mail::to($request->email)->send(new RegisterMail($visitor));
        }

        // Visitor data into visitor_logs table
        $visitor_id = Visitor::orderBy('visitor_id', 'desc')->first();
        $visitorLog = new VisitorLog;
        $visitorLog->visitor_id = $visitor_id->visitor_id;
        $visitorLog->user_id = $user_id->user_id;
        $visitorLog->visitor_type = $request->visitor_type;
        $visitorLog->first_name = $request->first_name;
        $visitorLog->last_name = $request->last_name;
        $visitorLog->organization = $request->organization;
        $visitorLog->designation = $request->designation;
        $visitorLog->gender = $request->gender;
        $visitorLog->dob = $request->dob;
        $visitorLog->mobile_no = $request->mobile_no;
        $visitorLog->email = $request->email;
        $visitorLog->address = $request->address;
        $visitorLog->profile_photo = $imgName;
        $visitorLog->nid_no = $request->nid_no;
        $visitorLog->passport_no = $request->passport_no;
        $visitorLog->driving_license_no = $request->driving_license_no;
        $visitorLog->entry_user_id = session('loggedUser');
        $visitorLog->entry_datetime = now();
        $visitorLog->description = "Visitor account created form reception panel";
        $visitorLog->log_type = 1;
        $visitorLog->status = 1;
        $visitorLog->save();


        Session()->flash('success' , 'Registration Successfull! Please check your email for verification.');
        return redirect()->route('reception.index');
    }

    // Display make an appointment visitor list
    public function appointVisitor()
    {
        $visitors = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->where('visitors.visitor_status', '=', '1')
                            ->get();
        return view('backend.pages.reception.appointVisitor', compact('visitors'));
    }

    // Display form for new visitor account and appointment
    public function visitorAndAppointment()
    {
        $visitorTypes = VisitorType::all();
        $purposes = MeetingPurpose::all();
        return view('backend.pages.reception.visitorAndAppointment', compact('visitorTypes', 'purposes'));
    }

    // Store new visitor and appointment info
    public function visitorAndAppointmentStore(Request $request)
    {
        // check if mobile number or email exist in users table
        $mobileCheck = User::where('mobile_no', '=', $request->mobile_no)->first();
        $emailCheck = User::where('email', '=', $request->email)->first();

        if ($mobileCheck || $emailCheck)
        {
            return redirect()->back()->with('sticky_error', 'Email address or Mobile number already exist');
        }
        $this->validation($request);

        // Login credentials into users table 
        $user = new User;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = '4';
        $user->entry_datetime = now();
        $userdone = $user->save();

        // Visitor information into visitors table
        $user_id = User::orderBy('user_id', 'desc')->first();
        $visitor = new Visitor;
        $visitor->user_id = $user_id->user_id;
        $visitor->visitor_type = $request->visitor_type;
        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->organization = $request->organization;
        $visitor->designation = $request->designation;
        $visitor->gender = $request->gender;
        $visitor->dob = $request->dob;
        $visitor->mobile_no = $request->mobile_no;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->nid_no = $request->nid_no;
        $visitor->passport_no = $request->passport_no;
        $visitor->driving_license_no = $request->driving_license_no;
        $visitor->entry_user_id = session('loggedUser');
        $visitor->slug = strtolower($request->first_name.'-'.$request->last_name);
        $visitor->entry_datetime = now();
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imgName = 'visitor'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($image)->save($location);
            $visitor->profile_photo = $imgName;
        }
        $visitordone = $visitor->save();

        // Activation mail to visitor email
        if ($request->email != NULL) 
        {
            mail::to($request->email)->send(new RegisterMail($visitor));
        }
        // Visitor data into visitor_logs table
        $visitor_id = Visitor::orderBy('visitor_id', 'desc')->first();
        $visitorLog = new VisitorLog;
        $visitorLog->visitor_id = $visitor_id->visitor_id;
        $visitorLog->user_id = $user_id->user_id;
        $visitorLog->visitor_type = $request->visitor_type;
        $visitorLog->first_name = $request->first_name;
        $visitorLog->last_name = $request->last_name;
        $visitorLog->organization = $request->organization;
        $visitorLog->designation = $request->designation;
        $visitorLog->gender = $request->gender;
        $visitorLog->dob = $request->dob;
        $visitorLog->mobile_no = $request->mobile_no;
        $visitorLog->email = $request->email;
        $visitorLog->address = $request->address;
        $visitorLog->profile_photo = $imgName;
        $visitorLog->nid_no = $request->nid_no;
        $visitorLog->passport_no = $request->passport_no;
        $visitorLog->driving_license_no = $request->driving_license_no;
        $visitorLog->entry_user_id = session('loggedUser');
        $visitorLog->entry_datetime = now();
        $visitorLog->description = "Visitor account created form reception panel";
        $visitorLog->log_type = 1;
        $visitorLog->status = 1;
        $visitorLog->save();

        // Insert meeting info into meetings table
        $meeting = new Meeting;
        $meeting->user_id = $user_id->user_id;
        $meeting->visitor_id = $visitor_id->visitor_id;
        $meeting->employee_id = $request->employee_id;
        $meeting->meeting_purpose_id = $request->meeting_purpose_id;
        $meeting->purpose_describe = $request->meeting_purpose_describe;
        $meeting->meeting_datetime = $request->meeting_datetime;
        $meeting->attendees_no = $request->attendees_no;
        $meeting->entry_user_id = session('loggedUser');
        $meeting->entry_datetime = now();
        $meeting->meeting_status = '0';
        $meeting->has_vehicle = $request->has_vehicle;
        $meetingdone = $meeting->save();

        // Insert data into meeting_logs table
        $meeting_id = Meeting::orderBy('meeting_id', 'desc')->first();
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting_id->meeting_id;
        $meetingLog->user_id = $user_id->user_id;
        $meetingLog->visitor_id = $visitor_id->visitor_id;
        $meetingLog->employee_id = $request->employee_id;
        $meetingLog->meeting_purpose_id = $request->meeting_purpose_id;
        $meetingLog->purpose_describe = $request->meeting_purpose_describe;
        $meetingLog->meeting_datetime = $request->meeting_datetime;
        $meetingLog->attendees_no = $request->attendees_no;
        $meetingLog->meeting_status = '0';
        $meetingLog->has_vehicle = $request->has_vehicle;
        $meetingLog->entry_user_id = session('loggedUser');
        $meetingLog->entry_datetime = now();
        $meetingLog->description = "Appointment placed from reception panel";
        $meetingLog->log_type = '5';
        $meetingLog->status = '1';
        $meetingLog->save();

        $employee_mail = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                ->select('meetings.*', 'visitors.first_name as vfname', 'visitors.last_name as vlname','employees.first_name as efname', 'employees.last_name as elname',  'employees.email')
                                ->where('visitors.visitor_id', '=', $visitor_id->visitor_id)
                                ->where('employees.employee_id', '=', $request->employee_id)
                                ->first();
        mail::to($employee_mail->email)->send(new AppointmentRequest($employee_mail));

        if ($userdone && $visitordone && $meetingdone)
        {
            return redirect()->route('reception.index')->with('success', 'Account created successfully, Please check your Email to active account. Appointment placed successfully, Please wait for Host permission');
        } else {
            return redirect()->route('reception.index')->with('sticky_error', 'Something went wrong, Please try again...!');
        }

    }

    // Display make an appointment form
    public function makeAnAppointment($visitor_id)
    {

        $purpose = MeetingPurpose::where('purpose_status', '=', 1)->get();
        return view('backend.pages.reception.makeAnAppointment', compact('purpose', 'visitor_id'));
    }

    // Search Employee
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

    // Place/store an appointment from reception
    public function placeAnAppointment(Request $req)
    {
        // Insert meeting info into meetings table
        $meeting = new Meeting;
        $user_id = session('loggedUser');
        $meeting->user_id = $user_id;
        $meeting->visitor_id = $req->visitor_id;
        $meeting->employee_id = $req->employee_id;
        $meeting->meeting_purpose_id = $req->meeting_purpose_id;
        $meeting->purpose_describe = $req->meeting_purpose_describe;
        $meeting->meeting_datetime = $req->meeting_datetime;
        $meeting->attendees_no = $req->attendees_no;
        $meeting->entry_user_id = $user_id;
        $meeting->entry_datetime = date('Y-m-d H:i:s');
        $meeting->meeting_status = '0';
        $meeting->has_vehicle = $req->has_vehicle;
        $done = $meeting->save();

        // Insert data into meeting_logs table
        $meeting_id = Meeting::orderBy('meeting_id', 'desc')->first();
        $meetingLog = new MeetingLog;
        $meetingLog->meeting_id = $meeting_id->meeting_id;
        $meetingLog->user_id = $user_id;
        $meetingLog->visitor_id = $req->visitor_id;
        $meetingLog->employee_id = $req->employee_id;
        $meetingLog->meeting_purpose_id = $req->meeting_purpose_id;
        $meetingLog->purpose_describe = $req->meeting_purpose_describe;
        $meetingLog->meeting_datetime = $req->meeting_datetime;
        $meetingLog->attendees_no = $req->attendees_no;
        $meetingLog->meeting_status = '0';
        $meetingLog->has_vehicle = $req->has_vehicle;
        $meetingLog->entry_user_id = $user_id;
        $meetingLog->entry_datetime = date('Y-m-d H:i:s');
        $meetingLog->description = "Appointment placed from reception panel";
        $meetingLog->log_type = '5';
        $meetingLog->status = '1';
        $meetingLog->save();


        $employee_mail = Meeting::join('visitors', 'visitors.visitor_id', '=', 'meetings.visitor_id')
                                ->join('employees', 'employees.employee_id', '=', 'meetings.employee_id')
                                ->select('meetings.*', 'visitors.first_name as vfname', 'visitors.last_name as vlname','employees.first_name as efname', 'employees.last_name as elname',  'employees.email')
                                ->where('visitors.visitor_id', '=', $req->visitor_id)
                                ->where('employees.employee_id', '=', $req->employee_id)
                                ->first();

        if ($done) {
            mail::to($employee_mail->email)->send(new AppointmentRequest($employee_mail));
            return redirect()->route('reception.index')->with('success', 'Your meeting placed successfully');
        } else {
            return redirect()->route('reception.index')->with('fail', 'Sorry...! Something went wrong, Please try again');
        }
    }

    // Display visitor profile
    public function visitorProfile($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', '=', $visitor_id)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->first();

        return view('backend.pages.reception.visitorProfile', compact('visitor'));
    }

    // Visitor check-in method
    public function checkIn(Request $req)
    {
        // logged user ID
        $user_id = session('loggedUser');

        // update meetings table
        $meeting = Meeting::where('meeting_id', $req->meeting_id)->first();
        $meeting->meeting_start_time = now();
        $meeting->meeting_status = 11;
        $meeting->checkin_status = 1;
        $meetingUpdated = $meeting->save();

        // insert new visitor_pass data
        $visitorPass = new VisitorPass;
        $visitorPass->visitor_id = $meeting->visitor_id;
        $visitorPass->meeting_id = $meeting->meeting_id;
        $visitorPass->checkin_time = now();
        $visitorPass->card_no = $req->card_no;
        $visitorPass->entry_user_id = $user_id;
        $visitorPass->visitor_pass_status = 1;
        
        // Webcam image processing
        $img = $req->visitor_photo;
        $folderPath = public_path('backend/img/meeting_attendees/');
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'visitor'.time() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $visitorPass->visitor_photo = $fileName;
        $visitorPassSaved = $visitorPass->save();

        if($meetingUpdated && $visitorPassSaved)
        {
            return redirect()->route('reception.meetingList')->with('success', 'Check-in Approved');
        }else{
            return redirect()->route('reception.meetingList')->with('sticky_error', 'Please try agrain...!');
        }

    }

    // Visitor check-out method
    public function checkOut($meeting_id)
    {
        $user_id = session('loggedUser');
        // Update meetings table data
        $meeting = Meeting::where('meeting_id', $meeting_id)->first();
        $meeting->meeting_end_time = now();
        $meeting->meeting_status = 12;
        $meeting->checkin_status = 2;
        $meetingDone = $meeting->save();

        // Update visitor_pass table data
        $visitorPass = VisitorPass::where('meeting_id', $meeting_id)->first();
        $visitorPass->checkout_time = now();
        $visitorPass->modified_user_id = $user_id;
        $visitorPass->visitor_pass_status = 0;
        $visitorPassDone = $visitorPass->save();

        if($meetingDone && $visitorPassDone)
        {
            return redirect()->route('reception.meetingList')->with('success', 'Check-out Done...');
        }else{
            return redirect()->route('reception.meetingList')->with('sticky_error', 'Please try agrain...!');
        }
    }
    

}
