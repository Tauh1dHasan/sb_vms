<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;

use App\Mail\EmployeeApprovedMail;
use App\Mail\EmployeeDeclinedMail;

use DB;

class EmployeeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display pending employee list.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $employees = DB::table('employees')
                    ->join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.status', '=', 0)
                    ->orderBy('employee_id' , 'desc')
                    ->get();

        return view('backend.pages.admin.pending-employee', compact('employees'));
    }

    public function approved()
    {
        $employees = DB::table('employees')
                    ->join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.status', '=', 1)
                    ->orderBy('employee_id' , 'desc')
                    ->get();

        return view('backend.pages.admin.approved-employee', compact('employees'));
    }

    public function declined()
    {
        $employees = DB::table('employees')
                    ->join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->select('employees.*', 'departments.department_name as department_name', 'designations.designation as designation')
                    ->where('employees.status', '=', 2)
                    ->orderBy('employee_id' , 'desc')
                    ->get();

        return view('backend.pages.admin.declined-employee', compact('employees'));
    }

    public function approve(User $user_id)
    {
        $user = DB::table('users')
                ->where('user_id', $user_id->user_id)
                ->update(['is_approved' => 1]);

        $employee = DB::table('employees')
                ->where('user_id', $user_id->user_id)
                ->update(['status' => 1]);

        $employees = DB::table('employees')
                ->where('user_id', $user_id->user_id)
                ->first();

        if($employees->email != NULL){
            mail::to($employees->email)->send(new EmployeeApprovedMail($employees));
        }

        Session()->flash('success' , 'Employee Account Approved Succesfully.');
        return redirect()->route('admin.approved.employees');
    }

    public function decline(User $user_id)
    {
        $user = DB::table('users')
                ->where('user_id', $user_id->user_id)
                ->update(['is_approved' => 0]);

        $employee = DB::table('employees')
                ->where('user_id', $user_id->user_id)
                ->update(['status' => 2]);

        $employees = DB::table('employees')
                ->where('user_id', $user_id->user_id)
                ->first();

        if($employees->email != NULL){
            mail::to($employees->email)->send(new EmployeeDeclinedMail($employees));
        }

        Session()->flash('success' , 'Employee Account Declined Succesfully.');
        return redirect()->route('admin.declined.employees');
    }
}
