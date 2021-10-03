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
        return view('backend.pages.reception.index');
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

        if ($gender == 1){
            $gender = "Male";
        } elseif ($gender == 2){
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

        $department = Department::where('status', '=', 1)->get();
        $designation = Designation::where('status', '=', 1)->get();

        return view('backend.pages.reception.editProfile', compact('employee', 'department', 'designation'));
    }

    // Update and store new profile information
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
            return redirect(route('reception.index'))->with('success', 'Profile successfully updated.');
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
        $this->validation($request);

        $user = new User;

        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = '4';
        $user->entry_datetime = now();

        $user->save();

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
        $visitor->slug = strtolower($request->first_name.'-'.$request->last_name);
        $visitor->entry_datetime = now();

        $visitor->profile_photo = $request->profile_photo;
        
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imgName = 'visitor'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/visitors/'.$imgName);
            Image::make($image)->save($location);

            $visitor->profile_photo = $imgName;
        }

        $visitor->save();

        if($visitor->email != NULL){
            mail::to($visitor->email)->send(new RegisterMail($visitor));
        }

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
        $user_id = session('loggedUser');

        $purpose = MeetingPurpose::where('purpose_status', '=', 1)->get();

        return view('backend.pages.reception.makeAnAppointment', compact('purpose', 'visitor_id', 'user_id'));
    }

    // Place/store an appointment from reception
    public function placeAnAppointment(Request $req)
    {
        return $req;
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

}
