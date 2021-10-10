<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

// include models
use App\Models\Visitor;
use App\Models\VisitorType;

class VisitorManageController extends Controller
{
    //Display all visitor list
    public function index()
    {
        $visitors = Visitor::join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')->get();
        return view('backend.pages.admin.visitor.index', compact('visitors'));
    }

    // Show visitor profile
    public function show($visitor_id)
    {
        $visitor = Visitor::where('visitor_id', $visitor_id)
                            ->join('visitor_types', 'visitors.visitor_type', '=', 'visitor_types.visitor_type_id')
                            ->first();
        return view('backend.pages.admin.visitor.profile', compact('visitor'));
    }
}
