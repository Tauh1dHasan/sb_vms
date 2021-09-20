<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VisitorType;
use App\Models\UserType;
use App\Models\Department;
use App\Models\Designation;

class IndexController extends Controller
{
    /* home page */
    public function index()
    {
        return view('index');
    }

    /* visitor register page */
    public function register()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();

        return view('frontend.pages.register', compact('visitor_types'));
    }

    /* about us page */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /* contact page */
    public function contact()
    {
        return view('frontend.pages.contact');
    }


    /* employee register page */
    public function employee_create()
    {
        $user_types = UserType::where('user_type_id' , '=', '2')
                    ->orWhere('user_type_id' , '=', '3')
                    ->get();
        $departments = Department::orderBy('dept_id' , 'asc')->get();
        $designations = Designation::orderBy('designation_id' , 'asc')->get();

        return view('frontend.pages.employee-register', compact('user_types', 'departments', 'designations'));
    }
}
