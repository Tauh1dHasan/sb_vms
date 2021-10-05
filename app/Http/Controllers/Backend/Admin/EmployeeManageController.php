<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/* included mails */
use App\Mail\EmployeeApprovedMail;
use App\Mail\EmployeeDeclinedMail;

/* included models */
use App\Models\User;
use App\Models\UserType;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

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
        $employees = Employee::join('departments', 'departments.dept_id', '=', 'employees.dept_id')
                            ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                            ->get(['employees.*', 'departments.department_name as department_name', 'designations.designation as designation']);

        return view('backend.pages.admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating an employee.
     */
    public function create()
    {
        $user_types = UserType::where([
                                    ['user_type_status' , '=', '1'],
                                    ['user_type_id' , '=', '2'],
                                ])
                                ->orWhere([
                                    ['user_type_status' , '=', '1'],
                                    ['user_type_id' , '=', '3'],
                                ])
                                ->get();

        $departments = Department::orderBy('dept_id' , 'asc')->get();
        $designations = Designation::orderBy('designation_id' , 'asc')->get();

        return view('backend.pages.admin.employee.create', compact('user_types', 'departments', 'designations'));
    }


    /**
     * Display list of all pending employees.
     */
    public function pending()
    {
        $employees = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.status', '=', 0)
                    ->orderBy('employee_id' , 'desc')
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
                    ->where('employees.status', '=', 1)
                    ->orderBy('employee_id' , 'desc')
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
                    ->where('employees.status', '=', 2)
                    ->orderBy('employee_id' , 'desc')
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

        Session()->flash('success', 'Employee Account Approved Succesfully.');
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

        Session()->flash('success', 'Employee Account Declined Succesfully.');
        return redirect()->back();
    }
}
