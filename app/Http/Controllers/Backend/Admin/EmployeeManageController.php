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
use App\Models\Employee;

class EmployeeManageController extends Controller
{
    /**
     * Display list of all employees.
     */
    public function index()
    {
        $employees = Employee::join('departments', 'departments.dept_id', '=', 'employees.dept_id')
                            ->join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                            ->get(['employees.*', 'departments.department_name as department_name', 'designations.designation as designation']);

        return view('backend.pages.admin.employee.allEmployees', compact('employees'));
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
