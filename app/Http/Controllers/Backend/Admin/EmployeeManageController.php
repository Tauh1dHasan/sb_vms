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
use App\Models\HostLog;

class EmployeeManageController extends Controller
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
     * Display list of all employees.
     */
    public function index()
    {
        $employees = Employee::join('departments', 'departments.dept_id', 'employees.dept_id')
                            ->join('designations', 'designations.designation_id', 'employees.designation_id')
                            ->where('employees.user_type_id', 2)
                            ->where('employees.status', '!=', 3)
                            ->orderBy('employees.employee_id', 'asc')
                            ->get(['employees.*', 'departments.department_name as department_name', 'designations.designation as designation']);

        return view('backend.pages.admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating an employee.
     */
    public function create()
    {
        $departments = Department::orderBy('dept_id' , 'asc')->get();
        $designations = Designation::orderBy('designation_id' , 'asc')->get();

        return view('backend.pages.admin.employee.create', compact('departments', 'designations'));
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
                $imgName = 'employee'.time().'.'.$image->getClientOriginalExtension();
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
                                'availability'=>1,
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
                $message->to($user->email, 'VMS Host Account')
                        ->subject('Account Approval');
            });
        }

        Session()->flash('success' , 'Host Created Successfully!!!');
        return redirect()->route('admin.employee.index');
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

        return view('backend.pages.admin.employee.show', compact('employee'));
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

        return view('backend.pages.admin.employee.edit', compact('employee', 'departments', 'designations'));
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

        if(($request->email == $user->email) and ($request->mobile_no == $employee->mobile_no)) {
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

        Session()->flash('success' , 'Host Info Updated Successfully !!!');
        return redirect()->route('admin.employee.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $employee = Employee::where('employee_id', $id)->first();

        return view('backend.pages.admin.employee.editPassword', compact('employee'));
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

        Session()->flash('success' , 'Host Password Updated Successfully !!!');
        return redirect()->route('admin.employee.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pendingUpdate()
    {
        $employees = HostLog::with('department', 'designation')
                            ->where('log_type', 2)
                            ->where('status', 1)
                            ->get();

        return view('backend.pages.admin.employee.pendingUpdate', compact('employees'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pendingUpdateShow($id)
    {
        $employee = HostLog::with('department', 'designation')
                            ->where('employee_id', $id)
                            ->first();

        return view('backend.pages.admin.employee.show', compact('employee'));
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
        return redirect()->route('admin.employee.index');
    }


    /**
     * Display list of all pending employees.
     */
    public function pending()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 2)
                    ->where('employees.status', '=', 0)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.employee.pendingEmployee', compact('employees'));
    }

    /**
     * Display list of all approved employees.
     */
    public function approved()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 2)
                    ->where('employees.status', '=', 1)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.employee.approvedEmployee', compact('employees'));
    }

    /**
     * Display list of declined employees.
     */
    public function declined()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.user_type_id', 2)
                    ->where('employees.status', '=', 2)
                    ->orderBy('employee_id' , 'asc')
                    ->get();

        return view('backend.pages.admin.employee.declinedEmployee', compact('employees'));
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

        Session()->flash('success', 'Host Account Approved Successfully.');
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

        Session()->flash('success', 'Host Account Declined Successfully.');
        return redirect()->back();
    }

    /**
     * approve a pending employee profile update
     */
    public function approvePendingUpdate(HostLog $log_id)
    {
    //     $user = User::where('user_id', $user_id->user_id)
    //             ->update(['is_approved' => 1]);

    //     $employee = Employee::where('user_id', $user_id->user_id)
    //                 ->update(['status' => 1]);

    //     $employees = Employee::where('user_id', $user_id->user_id)
    //                 ->first();

    //     if($employees->email != NULL){
    //         mail::to($employees->email)->send(new EmployeeApprovedMail($employees));
    //     }

    //     Session()->flash('success', 'Host Account Approved Successfully.');
    //     return redirect()->back();
    }

    /**
     * decline a pending employee profile update
     */
    public function declinePendingUpdate(HostLog $log_id)
    {
        // $user = User::where('user_id', $user_id->user_id)
        //         ->update(['is_approved' => 0]);

        // $employee = Employee::where('user_id', $user_id->user_id)
        //             ->update(['status' => 2]);

        // $employees = Employee::where('user_id', $user_id->user_id)
        //             ->first();

        // if($employees->email != NULL){
        //     mail::to($employees->email)->send(new EmployeeDeclinedMail($employees));
        // }

        // Session()->flash('success', 'Host Account Declined Successfully.');
        // return redirect()->back();
    }
}
