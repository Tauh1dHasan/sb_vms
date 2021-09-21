<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function index()
    {
        return view('backend.pages.admin.index');
    }

    public function login()
    {
        return view('backend.pages.admin.login');
    }
}
