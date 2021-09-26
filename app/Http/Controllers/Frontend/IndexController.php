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
     * Display front-end home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display front-end registration/visitor registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $visitor_types = VisitorType::orderBy('visitor_type_id' , 'asc')->get();

        return view('frontend.pages.register', compact('visitor_types'));
    }

    /**
     * Display front-end about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /**
     * Display front-end contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }


    /**
     * Display Employee Registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_create()
    {
        $user_types = UserType::where('user_type_status' , '=', '1')
                    ->where('user_type_id' , '=', '2')
                    ->get();
        $departments = Department::orderBy('dept_id' , 'asc')->get();
        $designations = Designation::orderBy('designation_id' , 'asc')->get();

        return view('frontend.pages.employee-register', compact('user_types', 'departments', 'designations'));
    }
}
