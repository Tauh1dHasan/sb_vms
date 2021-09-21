<?php

use Illuminate\Support\Facades\Route;

/* Frontend Controllers */
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\EmployeeAuthController;

// Visitor's Controller
use App\Http\Controllers\Backend\Visitor\VisitorController;
use App\Http\Controllers\Backend\Visitor\MeetingController;

// Employee's Controller
use App\Http\Controllers\Backend\Employee\EmployeeController;

/* Admin Controllers */
use App\Http\Controllers\Backend\Admin\AdminIndexController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Frontend Routes */
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => '/', 'as' => 'frontend.'], function() {
    Route::get('about', [IndexController::class, 'about'])->name('about');
    Route::get('contact', [IndexController::class, 'contact'])->name('contact');

    Route::get('register', [IndexController::class, 'register'])->name('register');
    Route::post('user-register', [UserAuthController::class, 'user_registration'])->name('user_registration');
    // Route::get('user-verify/{user_id}', [UserAuthController::class, 'user_verify'])->name('user_verify');
    Route::post('/visitor', [UserAuthController::class, 'user_login'])->name('user_login');
    Route::get('user-logout', [UserAuthController::class, 'user_logout'])->name('user_logout');

    /* Employee Register Routes */
    Route::get('employee/register', [IndexController::class, 'employee_create'])->name('employee.create');
    Route::post('employee/store', [EmployeeAuthController::class, 'store'])->name('employee.store');
    Route::post('employee/designations', [EmployeeAuthController::class, 'dept_wise_designation'])->name('employee.designation');
    Route::post('/employee', [EmployeeAuthController::class, 'employee_login'])->name('employee.login');
}); 

/* Backend User/Visitor Routes */
Route::group(['middleware' => ['UserMiddleware'],'prefix' => '/visitor', 'as' => 'visitor.'], function() {
    // Dashboard page for visitor
    Route::get('/', [VisitorController::class, 'dashboard'])->name('index');

    // Show visitor's profile page
    Route::get('/profile', [VisitorController::class, 'profile'])->name('profile');

    // Visitor profile update
    Route::get('/edit-profile/{user_id}', [VisitorController::class, 'edit']);
    Route::post('/update-profile', [VisitorController::class, 'update'])->name('update-profile');
    
    // Show form to create a meeting
    Route::get('/make-an-appointment', [MeetingController::class, 'create'])->name('create');

    // Store a meeting routes for visitor
    Route::post('/create-meeting', [MeetingController::class, 'store'])->name('store');
    // search employees
    Route::post('/search-employees', [MeetingController::class, 'search_employees'])->name('search-employees');

    // Show all meeting status
    Route::get('/all-appointments', [MeetingController::class, 'index'])->name('all_meetings');

    // Show all approved meetings
    Route::get('/approved-meetings', [MeetingController::class, 'approved'])->name('approvedMeetings');

    // Show all pending meetings
    Route::get('/pending-meetings', [MeetingController::class, 'pending'])->name('pendingaMeetings');

    // Show all rejected meetings
    Route::get('/rejected-meetings', [MeetingController::class, 'rejected'])->name('rejectedMeetings');

    // Cancel meeting from visitor panel
    Route::post('/cancel-meeting', [MeetingController::class, 'cancel_meeting'])->name('cancel-meeting');

    // Show meeting visitor-pass QR code to visitor
    Route::post('/visitor-pass', [MeetingController::class, 'visitor_pass'])->name('visitorPass');
    // Gate Pass -- This route will be moved to receptionist module -- only receptionist will see this info and provide a gate pass
    Route::get('/gate-pass/{$meeting_id}', [MeetingController::class, 'gate_pass'])->name('gatePass');

    // getting host name with auto suggest
    Route::get('/get-host', [MeetingController::class, 'getHost'])->name('getHost');

    // All appointments custom filtering
    Route::post('/custom-report', [MeetingController::class, 'custom_report'])->name('custom-report');
}); 



/* Backend User/Visitor Routes */
Route::group(['prefix' => '/employee', 'as' => 'employee.'], function() {
    // Dashboard page for visitor
    Route::get('/', [EmployeeController::class, 'dashboard'])->name('index');
}); 



/* Backend Admin Routes */
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {
    Route::get('/', [AdminIndexController::class, 'index'])->name('index');
}); 