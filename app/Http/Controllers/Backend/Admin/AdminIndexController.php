<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* include models */
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Meeting;

class AdminIndexController extends Controller
{
    public function index()
    {
        /* all approved employees count */
        $approved_employees = Employee::where('status', '=', '1')->get();
        $approved_employees_count = $approved_employees->count();

        /* all visitors count */
        $visitors = Visitor::where('visitor_status', '=', '1')->get();
        $visitors_count = $visitors->count();

        /* all meetings count */
        $meetings = Meeting::get();
        $meetings_count = $meetings->count();

        /* all today's meetings count */
        $y_date = date('Y-m-d',strtotime("-1 days"));
        $t_date = date('Y-m-d',strtotime("+1 days"));

        $today_meetings = Meeting::where('meetings.meeting_datetime', '>', $y_date)
                                    ->where('meetings.meeting_datetime', '<', $t_date)
                                    ->get();
        $today_meetings_count = $today_meetings->count();

        return view('backend.pages.admin.index', compact('approved_employees_count', 'visitors_count', 'meetings_count', 'today_meetings_count'));
    }

    public function login()
    {
        return view('backend.pages.admin.login');
    }
}
