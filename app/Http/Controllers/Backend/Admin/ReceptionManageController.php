<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

/* included mails */
use App\Mail\EmployeeApprovedMail;
use App\Mail\EmployeeDeclinedMail;

/* included models */
use App\Models\User;
use App\Models\UserType;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\ReceptionLog;

class ReceptionManageController extends Controller
{
    /**
     * Employee Create validation.
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'dept_id' => 'required',
            'designation_id' => 'required',
            'eid_no' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'mobile_no' => 'required|unique:users|min:11',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'photo' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
    }


    /**
     * Display list of all receptionists.
     */
    public function index()
    {
        $employees = Employee::join('departments', 'departments.dept_id', 'employees.dept_id')
                            ->join('designations', 'designations.designation_id', 'employees.designation_id')
                            ->where('employees.user_type_id', 3)
                            ->where('employees.status', '!=', 3)
                            ->orderBy('employees.employee_id', 'asc')
                            ->get(['employees.*', 'departments.department_name as department_name', 'designations.designation as designation']);

        return view('backend.pages.admin.reception.index', compact('employees'));
    }

    /**
     * Show the form for creating an employee.
     */
    public function create()
    {
        $departments = Department::orderBy('dept_id' , 'asc')->get();
        $designations = Designation::orderBy('designation_id' , 'asc')->get();

        return view('backend.pages.admin.reception.create', compact('departments', 'designations'));
    }

    /**
     * Store employee data.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $session_user = session('loggedUser');

        $password = $request->password;

        $user = User::create([
                                'mobile_no'=>$request->mobile_no,
                                'email'=>$request->email,
                                'password'=>bcrypt($password),
                                'user_type_id'=>$request->user_type_id,
                                'is_approved'=>1,
                                'entry_datetime'=>now()
                            ]);

        $user_id = User::orderBy('user_id', 'desc')->first();
        
        if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imgName = 'reception'.time().'.'.$image->getClientOriginalExtension();
                $location = public_path('backend/img/employees/'.$imgName);
                Image::make($image)->save($location);
        } else {
            $imgName = NULL;
        }

        $employee = Employee::create([
                                'user_id'=>$user_id->user_id,
                                'user_type_id'=>$request->user_type_id,
                                'first_name'=>$request->first_name,
                                'last_name'=>$request->last_name,
                                'slug'=>Str::slug($request->first_name.' '.$request->last_name),
                                'eid_no'=>$request->eid_no,
                                'dept_id'=>$request->dept_id,
                                'designation_id'=>$request->designation_id,
                                'gender'=>$request->gender,
                                'dob'=>$request->dob,
                                'mobile_no'=>$request->mobile_no,
                                'email'=>$request->email,
                                'start_hour'=>$request->start_hour,
                                'end_hour'=>$request->end_hour,
                                'building_no'=>$request->building_no,
                                'gate_no'=>$request->gate_no,
                                'elevator_no'=>$request->elevator_no,
                                'floor_no'=>$request->floor_no,
                                'room_no'=>$request->room_no,
                                'address'=>$request->address,
                                'nid_no'=>$request->nid_no,
                                'passport_no'=>$request->passport_no,
                                'driving_license_no'=>$request->driving_license_no,
                                'photo'=>$imgName,
                                'entry_user_id'=>$session_user,
                                'entry_datetime'=>now(),
                                'status'=>1
                            ]);

        if($request->email != NULL){
            $data = [
                'mobile_no'=>$user->mobile_no,
                'email'=>$user->email,
                'first_name'=>$employee->first_name,
                'last_name'=>$employee->last_name,
                'password' => $password
            ];

            Mail::send('backend.mails.employeeAccountCreate', ["data1"=>$data] , function($message) use($user){
                $message->to($user->email, 'VMS Reception Account')
                        ->subject('Account Approval');
            });
        }

        Session()->flash('success' , 'Receptionist Created Successfully!!!');
        return redirect()->route('admin.receptionist.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with('department', 'designation')
                            ->where('employee_id', $id)
                            ->first();

        return view('backend.pages.admin.reception.show', compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::with('department', 'designation')
                            ->where('employee_id', $id)
                            ->first();

        $departments = Department::where('status', '=', 1)
                                ->orderBy('dept_id', 'asc')
                                ->get();

        $designations = Designation::where('status', '=', 1)
                                    ->orderBy('designation_id', 'asc')
                                    ->get();

        return view('backend.pages.admin.reception.edit', compact('employee', 'departments', 'designations'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $user =  $employee->user;

        if(($request->email == $user->email) and ($request->mobile_no == $user->mobile_no)) {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'dept_id' => 'required',
                'designation_id' => 'required',
                'eid_no' => 'required',
                'start_hour' => 'required',
                'end_hour' => 'required',
                'mobile_no' => 'required|min:11',
                'email' => 'required',
                'photo' => 'mimes:jpeg,png,jpg|max:2048'
            ]);
        } else {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'dept_id' => 'required',
                'designation_id' => 'required',
                'eid_no' => 'required',
                'start_hour' => 'required',
                'end_hour' => 'required',
                'mobile_no' => 'required|unique:users|min:11',
                'email' => 'required|unique:users',
                'photo' => 'mimes:jpeg,png,jpg|max:2048'
            ]);
        }

        $user_id = session('loggedUser');

        $old_photo = $request->old_photo;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imgName = 'employee'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($image)->save($location);
            File::delete(public_path() . '/backend/img/employees/'. $old_photo);
        } else {
            $imgName = $old_photo;
        }

        $user = User::where('user_id', $user_id)
                    ->update([
                        'mobile_no'=>$request->mobile_no,
                        'email'=>$request->email,
                        'is_approved'=>$request->status,
                        'modified_datetime'=>now()
                    ]);

        $employee = Employee::where('employee_id', $employee->employee_id)
                            ->update([
                                'first_name'=>$request->first_name,
                                'last_name'=>$request->last_name,
                                'slug'=>Str::slug($request->first_name.' '.$request->last_name),
                                'eid_no'=>$request->eid_no,
                                'dept_id'=>$request->dept_id,
                                'designation_id'=>$request->designation_id,
                                'gender'=>$request->gender,
                                'dob'=>$request->dob,
                                'mobile_no'=>$request->mobile_no,
                                'email'=>$request->email,
                                'start_hour'=>$request->start_hour,
                                'end_hour'=>$request->end_hour,
                                'building_no'=>$request->building_no,
                                'gate_no'=>$request->gate_no,
                                'elevator_no'=>$request->elevator_no,
                                'floor_no'=>$request->floor_no,
                                'room_no'=>$request->room_no,
                                'address'=>$request->address,
                                'nid_no'=>$request->nid_no,
                                'passport_no'=>$request->passport_no,
                                'driving_license_no'=>$request->driving_license_no,
                                'photo'=>$imgName,
                                'modified_user_id'=>$user_id,
                                'modified_datetime'=>now(),
                                'availability'=>$request->availability,
                                'status'=>$request->status
                            ]);

        Session()->flash('success' , 'Receptionist Info Updated Successfully !!!');
        return redirect()->route('admin.reception.index');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $employee = Employee::where('employee_id', $id)
                            ->first();

        return view('backend.pages.admin.reception.editPassword', compact('employee'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        $user_id = session('loggedUser');

        $user = User::where('user_id', $user_id)
                    ->update([
                        'password'=>$request->password,
                        'modified_datetime'=>now()
                    ]);

        Session()->flash('success' , 'Receptionist Password Updated Successfully !!!');
        return redirect()->route('admin.reception.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = session('loggedUser');
        
        $user = User::where('user_id', $id)
                                    ->update([
                                        'is_approved'=>3,
                                        'modified_datetime'=>now()
                                    ]);
        
        $employee = Employee::where('user_id', $id)
                                    ->update([
                                        'status'=>3,
                                        'modified_user_id'=>$user_id,
                                        'modified_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Host Deleted Successfully !!!');
        return redirect()->route('admin.reception.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pendingUpdate()
    {
        $employees = ReceptionLog::with('department', 'designation')
                            ->where('log_type', 2)
                            ->where('status', 1)
                            ->get();

        return view('backend.pages.admin.reception.pendingUpdate', compact('employees'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pendingUpdateShow($employee_id)
    {
        $new_info = ReceptionLog::with('department', 'designation')
                            ->where('employee_id', $employee_id)
                            ->where('user_type_id', 3)
                            ->where('log_type', 2)
                            ->first();

        $old_info = Employee::with('department', 'designation')
                            ->where('employee_id', $employee_id)
                            ->where('user_type_id', 3)
                            ->first();

        return view('backend.pages.admin.reception.pendingUpdateShow', compact('new_info', 'old_info'));
    }


    /**
     * Display list of all pending employees.
     */
    public function pending()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 3)
                    ->where('employees.status', '=', 0)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.reception.pendingEmployee', compact('employees'));
    }


    /**
     * Display list of all approved employees.
     */
    public function approved()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 3)
                    ->where('employees.status', '=', 1)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.reception.approvedEmployee', compact('employees'));
    }


    /**
     * Display list of declined employees.
     */
    public function declined()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 3)
                    ->where('employees.status', '=', 2)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.reception.declinedEmployee', compact('employees'));
    }


    /**
     * approve a pending or declined employee.
     */
    public function approve(User $user_id)
    {
        $user = User::where('user_id', $user_id->user_id)
                ->update(['is_approved' => 1]);

        $employee = Employee::where('user_id', $user_id->user_id)
                    ->update(['status' => 1]);

        $employees = Employee::where('user_id', $user_id->user_id)
                    ->first();

        if($employees->email != NULL){
            mail::to($employees->email)->send(new EmployeeApprovedMail($employees));
        }

        Session()->flash('success', 'Receptionist Account Approved Succesfully.');
        return redirect()->back();
    }
    

    /**
     * decline a pending employee.
     */
    public function decline(User $user_id)
    {
        $user = User::where('user_id', $user_id->user_id)
                    ->update(['is_approved' => 0]);

        $employee = Employee::where('user_id', $user_id->user_id)
                            ->update(['status' => 2]);

        $employees = Employee::where('user_id', $user_id->user_id)
                            ->first();

        if($employees->email != NULL){
            mail::to($employees->email)->send(new EmployeeDeclinedMail($employees));
        }

        Session()->flash('success', 'Receptionist Account Declined Succesfully.');
        return redirect()->back();
    }


    /**
     * approve a pending employee profile update
     */
    public function approvePendingUpdate($employee_id)
    {
        $user_id = session('loggedUser');

        $update_data = ReceptionLog::where('employee_id', $employee_id)
                                ->where('log_type', 2)
                                ->first();

        $hostlog = ReceptionLog::where('employee_id', $employee_id)
                            ->where('log_type', 2)
                            ->update([
                                'log_type' => 4,
                                'description' => "Profile Update Request Approved",
                                'modified_user_id' => $user_id,
                                'modified_datetime' => now(),
                            ]);
                    
        $user = User::where('user_id', $update_data->user_id)
                    ->update([
                        'mobile_no'=>$update_data->mobile_no,
                        'email'=>$update_data->email,
                        'modified_datetime'=>now()
                    ]);
                    

        $employee = Employee::where('employee_id', $employee_id)
                            ->where('user_type_id', 3)  
                            ->update([
                                'first_name' => $update_data->first_name,
                                'last_name' => $update_data->last_name,
                                'slug'=>Str::slug($update_data->first_name.' '.$update_data->last_name),
                                'gender' => $update_data->gender,
                                'dob' => $update_data->dob,
                                'dept_id' => $update_data->dept_id,
                                'designation_id' => $update_data->designation_id,
                                'mobile_no' => $update_data->mobile_no,
                                'email' => $update_data->email,
                                'address' => $update_data->address,
                                'photo' => $update_data->photo,
                                'nid_no' => $update_data->nid_no,
                                'passport_no' => $update_data->passport_no,
                                'driving_license_no' => $update_data->driving_license_no,
                                'start_hour' => $update_data->start_hour,
                                'end_hour' => $update_data->end_hour,
                                'building_no' => $update_data->building_no,
                                'gate_no' => $update_data->gate_no,
                                'floor_no' => $update_data->floor_no,
                                'elevator_no' => $update_data->elevator_no,
                                'room_no' => $update_data->room_no,
                                'modified_user_id' => $update_data->entry_user_id,
                                'modified_datetime' => $update_data->entry_datetime,
                            ]);

        Session()->flash('success', 'Receptionist Profile Updates Approved Successfully.');
        return redirect()->route('admin.receptionist.pendingUpdate');
    }


    /**
     * decline a pending employee profile update
     */
    public function declinePendingUpdate($employee_id)
    {
        $user_id = session('loggedUser');
        
        $hostlog = ReceptionLog::where('employee_id', $employee_id)
                            ->where('log_type', 2)
                            ->update([
                                'log_type' => 5,
                                'description' => "Profile Update Request Declined",
                                'modified_user_id' => $user_id,
                                'modified_datetime' => now(),
                            ]);

        Session()->flash('success', 'Receptionist Profile Updates Declined Successfully.');
        return redirect()->route('admin.receptionist.pendingUpdate');
    }
}
