<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* included models */
use App\Models\VisitorType;
use App\Models\UserType;
use App\Models\Department;
use App\Models\Designation;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display visitor registration page
     */
    public function register()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();

        return view('frontend.pages.register', compact('visitor_types'));
    }

    /**
     * Display about us page
     */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /**
     * Display contact us page
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }


    /**
     * Display Employee Registration page
     */
    public function employeeCreate()
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
        $departments = Department::where('status', '=', 1)
                                ->orderBy('dept_id', 'asc')
                                ->get();
        $designations = Designation::where('status', '=', 1)
                                    ->orderBy('designation_id', 'asc')
                                    ->get();

        return view('frontend.pages.employee-register', compact('user_types', 'departments', 'designations'));
    }
}
