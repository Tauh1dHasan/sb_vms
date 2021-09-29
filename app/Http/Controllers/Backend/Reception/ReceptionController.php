<?php

namespace App\Http\Controllers\Backend\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        
        return "Reception Profile page";
    }

    // Reception change password form display
    public function editPassword()
    {

        return view('backend.pages.reception.profile');
    }
}
