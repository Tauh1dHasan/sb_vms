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
            '_answer'=>'required|simple_captcha',
        ]);
    }

    // Reception Dashboard method
    public function dashboard()
    {
        $user_id = session('loggedUser');
        $user_name = Employee::select('first_name', 'last_name')->where('user_id', '=', $user_id)->first();

        // Total Appointment count
        $total_appopintment = Meeting::all()->count();

        $y_date = date('Y-m-d 00:00:00',strtotime("-1 days"));
        $t_date = date('Y-m-d 00:00:00',strtotime("+1 days"));
        // Total number of today's appointments
        $today_meeting = Meeting::where('meeting_datetime', '>', $y_date)
                                ->where('meeting_datetime', '<', $t_date)
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

        $gender = $employee->gender;

        if ($gender == 1) {
            $gender = "Male";
        } elseif ($gender == 2) {
            $gender = "Female";
        } else {
            $gender = "Not given";
        }

        return view('backend.pages.reception.profile', compact('employee', 'gender'));
    }

    // Display reception edit profile form
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

        return view('backend.pages.reception.editProfile', compact('employee', 'departments', 'designations', 'gender', 'gender_id'));
    }

    // Update and store new profile information
    public function updateProfile(Request $req)
    {
        // get employee old data
        $user_id = session('loggedUser');
        $employee_old_data_query = Employee::where('user_id', '=', $user_id)->first();
        $employee_id = $employee_old_data_query->employee_id;
        $user_type_id = $employee_old_data_query->user_type_id;
        $employee_dept_id = $employee_old_data_query->dept_id;
        $employee_designation_id = $employee_old_data_query->designation_id;
        $employee_old_photo = $employee_old_data_query->photo;

        // insert new/updated data into reception_logs table
        $receptionlog = new ReceptionLog;
        $receptionlog->employee_id = $employee_id;
        $receptionlog->user_id = $user_id;
        $receptionlog->user_type_id = $user_type_id;
        $receptionlog->first_name = $req->first_name;
        $receptionlog->last_name = $req->last_name;
        $receptionlog->gender = $req->gender;
        $receptionlog->dob = $req->dob;
        $receptionlog->eid_no = $req->eid_no;
        $receptionlog->dept_id = $employee_dept_id;
        $receptionlog->designation_id = $employee_designation_id;
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
            $receptionlog->photo = $employee_old_photo;
        }

        $done = $receptionlog->save();

        if ($done) 
        {
            return redirect(route('reception.index'))->with('success', 'Profile update request send to admin...');
        } else {
            return redirect(route('reception.index'))->with('fail', 'Something went wrong, Please try agrain.');
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
                           ->select('meeting_id', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no as vmobile', 'organization', 'designation', 'employees.first_name as efname', 'employees.last_name as elname', 'employees.mobile_no as emobile', 'purpose_name', 'purpose_describe', 'meeting_datetime', 'meeting_status')
                           ->get();

        return view('backend.pages.reception.meetingList', compact('meetings'));
    }

    // Search Meeting
    public function searchMeeting(Request $req)
    {
        $data = $req->data;

        $meetings = Meeting::join('visitors', 'meetings.visitor_id', '=', 'visitors.visitor_id')
                            ->join('employees', 'meetings.employee_id', '=', 'employees.employee_id')
                            ->join('meeting_purposes', 'meetings.meeting_purpose_id', '=', 'meeting_purposes.purpose_id')
                            ->where(function($item)use($data){
                                $item->where('visitors.first_name', 'LIKE', "%{$data}%")
                                     ->orWhere('visitors.last_name', 'LIKE', "%{$data}%")
                                     ->orWhere('visitors.mobile_no', 'LIKE', "%{$data}%");
                            })
                            ->select('meeting_id', 'visitors.first_name as vfname', 'visitors.last_name as vlname', 'visitors.mobile_no as vmobile', 'organization', 'designation', 'employees.first_name as efname', 'employees.last_name as elname', 'employees.mobile_no as emobile', 'purpose_name', 'purpose_describe', 'meeting_datetime', 'meeting_status')
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
            return redirect()->back()->with('fail', 'Email address or Mobile number already exist');
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
        if ($visitor->email != NULL) 
        {
            mail::to($visitor->email)->send(new RegisterMail($visitor));
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
        $meetingLog->meeting_status = '0';
        $meetingLog->has_vehicle = $req->has_vehicle;
        $meetingLog->entry_user_id = $user_id;
        $meetingLog->entry_datetime = date('Y-m-d H:i:s');
        $meetingLog->description = "Appointment placed from reception panel";
        $meetingLog->log_type = '1';
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
        $gender = $visitor->gender;
        if ($gender == '1')
        {
            $gender = "Male";
        } elseif ($gender == '2')
        {
            $gender = "Female";
        } else {
            $gender = "Not Provided";
        }
        return view('backend.pages.reception.visitorProfile', compact('visitor', 'gender'));
    }
    

}
