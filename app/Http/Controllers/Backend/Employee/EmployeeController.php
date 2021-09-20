<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Show Employee Dashboard
    public function dashboard()
    {
        return view('backend.index');
    }
}
