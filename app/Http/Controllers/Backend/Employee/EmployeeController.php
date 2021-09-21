<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Meeting;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MeetingPurpose;

class EmployeeController extends Controller
{
    // Show Employee Dashboard
    public function dashboard()
    {
        return view('backend.pages.employee.index');
    }

    // Show all meeting
    public function allMeetings()
    {
        $user_id = session('loggedUser');

        return "All appointment controller";
    }

    // Show today's meetings
    public function todayMeetings()
    {
        return "Today's appointments controller";
    }

    // Show all pending meetings
    public function pendingMeetings()
    {
        return "All time pending appointments";
    }

    // Show all approved meetings
    public function approvedMeetings()
    {
        return "All time approved appointments";
    }

    // Show all rejected meetings
    public function rejectedMeetings()
    {
        return "All time rejected appointments";
    }

    // Show host profile
    public function profile()
    {
        $user_id = session('loggedUser');

        $employee = DB::table('employees')
                    ->join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->where('user_id', $user_id)
                    ->first();
        $gender = $employee->gender;
        if($gender == 1){
            $gender = "Male";
        }elseif($gender == 2){
            $gender = "Female";
        }else{
            $gender = "Not given";
        }

        return view('backend.pages.employee.profile', compact('employee', 'gender'));
    }

    // Show host profile update form
    public function edit($user_id)
    {
        $employee = DB::table('employees')
                    ->join('departments', 'employees.dept_id', '=', 'departments.dept_id')
                    ->join('designations', 'employees.designation_id', '=', 'designations.designation_id')
                    ->where('user_id', $user_id)
                    ->first();

        $department = DB::table('departments')->get();
        $designation = DB::table('designations')->get();

        return view('backend.pages.employee.edit_profile', compact('employee', 'department', 'designation'));
    }

    // Host profile update/store method
    public function updateProfile(Request $req)
    {   
        $user_id = $req->user_id;

        $employee = Employee::find($user_id);
        $employee->first_name = $req->fname;
        $employee->last_name = $req->lname;
        $employee->dept_id = $req->department;
        $employee->designation_id = $req->designation;
        $employee->eid_no = $req->eid;
        $employee->email = $req->email;
        $employee->address = $req->address;
        $employee->mobile_no = $req->mobile_no;
        $employee->nid_no = $req->nid_no;
        $employee->passport_no = $req->passport_no;
        $employee->driving_license_no = $req->driving_license_no;
        $employee->start_hour = $req->start_hour;
        $employee->end_hour = $req->end_hour;
        $done = $employee->save();

        if($done){
            return redirect(route('employee.index'))->with('success', 'Profile successfully updated.');
        }else{
            return redirect(route('employee.index'))->with('fail', 'Something went wrong, Please try agrain.');
        }
    }
}
