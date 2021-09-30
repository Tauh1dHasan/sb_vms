<?php

namespace App\Http\Controllers\Backend\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    // Reception change password form display
    public function editPassword()
    {

        return view('backend.pages.reception.profile');
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


}
