<?php

use Illuminate\Support\Facades\Route;

/* Frontend Controllers */
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\EmployeeAuthController;

/* Visitor's Controller */
use App\Http\Controllers\Backend\Visitor\VisitorController;
use App\Http\Controllers\Backend\Visitor\MeetingController;

/* Employee's Controller */
use App\Http\Controllers\Backend\Employee\EmployeeController;

// Reception Controller
use App\Http\Controllers\Backend\Reception\ReceptionController;

/* Admin Controllers */
use App\Http\Controllers\Backend\Admin\AdminIndexController;
use App\Http\Controllers\Backend\Admin\EmployeeManageController;
use App\Http\Controllers\Backend\Admin\VisitorTypeController;


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
    Route::post('user-register', [UserAuthController::class, 'userRegistration'])->name('user_registration');
    Route::get('user-verify/{user_id}', [UserAuthController::class, 'userVerify'])->name('user_verify');
    Route::post('/visitor', [UserAuthController::class, 'userLogin'])->name('user_login');
    Route::get('user-logout', [UserAuthController::class, 'userLogout'])->name('user_logout');

    /* Employee Register Routes */
    Route::get('employee/register', [IndexController::class, 'employeeCreate'])->name('employee.create');
    Route::post('employee/store', [EmployeeAuthController::class, 'store'])->name('employee.store');
    Route::post('employee/designations/{id}', [EmployeeAuthController::class, 'deptWiseDesignation'])->name('employee.designation');
    Route::post('/employee', [EmployeeAuthController::class, 'employeeLogin'])->name('employee.login');
}); 

/* Backend Visitor Routes */
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
    Route::get('/search-employees', [MeetingController::class, 'searchEmployees'])->name('search-employees');

    // Show all meeting status
    Route::get('/all-appointments', [MeetingController::class, 'index'])->name('all_meetings');

    // Show all approved meetings
    Route::get('/approved-meetings', [MeetingController::class, 'approved'])->name('approvedMeetings');

    // Show all pending meetings
    Route::get('/pending-meetings', [MeetingController::class, 'pending'])->name('pendingaMeetings');

    // Show all re-scheduled meetings
    Route::get('/reschedule-meeting', [MeetingController::class, 'reschedule'])->name('rescheduledMeetings');

    // Show all rejected meetings
    Route::get('/rejected-meetings', [MeetingController::class, 'rejected'])->name('rejectedMeetings');

    // Cancel meeting from visitor panel
    Route::post('/cancel-meeting', [MeetingController::class, 'cancelMeeting'])->name('cancel-meeting');

    // Show meeting visitor-pass QR code to visitor
    Route::post('/visitor-pass', [MeetingController::class, 'visitorPass'])->name('visitorPass');
    // Gate Pass -- This route will be moved to receptionist module -- only receptionist will see this info and provide a gate pass
    Route::get('/gate-pass/{$meeting_id}', [MeetingController::class, 'gate_pass'])->name('gatePass');

    // getting host name with auto suggest
    Route::get('/get-host', [MeetingController::class, 'getHost'])->name('getHost');

    // All appointments custom filtering
    Route::post('/custom-report', [MeetingController::class, 'customReport'])->name('custom-report');

    // Visitor change password
    Route::get('/edit-password', [VisitorController::class, 'editPassword'])->name('editPassword');
    Route::post('/update-password', [VisitorController::class, 'updatePassword'])->name('updatePassword');
}); 



/* Backend Employee Routes */
Route::group(['middleware' => ['EmployeeMiddleware'], 'prefix' => '/employee', 'as' => 'employee.'], function() {
    // Dashboard page for visitor
    Route::get('/', [EmployeeController::class, 'dashboard'])->name('index');

    // Show all meeting of this host
    Route::get('/all-meetings', [EmployeeController::class, 'allMeetings'])->name('allMeetings');

    // Custom search for all appointments
    Route::post('/custom-meeting-search', [EmployeeController::class, 'customMeetingSearch'])->name('customMeetingSearch');

    // Show all today's meeting of this host
    Route::get('/today-meetings', [EmployeeController::class, 'todayMeetings'])->name('todayMeetings');

    // Show all pending meetings
    Route::get('/pending-meetings', [EmployeeController::class, 'pendingMeetings'])->name('pendingMeetings');

    // Show all approved meetings
    Route::get('/approved-meetings', [EmployeeController::class, 'approvedMeetings'])->name('approvedMeetings');

    // Show all re-scheduled meetings
    Route::get('/rescheduled-meetings', [EmployeeController::class, 'rescheduledMeetings'])->name('rescheduledMeetings');

    // Show all declined meetings
    Route::get('/rejected-meetings', [EmployeeController::class, 'rejectedMeetings'])->name('rejectedMeetings');

    // Employee profile route
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');

    // Employee edit profile route
    Route::get('/edit-profile/{user_id}', [EmployeeController::class, 'edit']);

    // Updade host profile
    Route::post('/update-profile', [EmployeeController::class, 'updateProfile'])->name('updateProfile');

    // Meeting decline route
    Route::post('/decline-meeting', [EmployeeController::class, 'declineMeeting'])->name('declineMeeting');

    // Meeting approve route
    Route::post('/approve-meeting', [EmployeeController::class, 'approveMeeting'])->name('approveMeeting');

    // Meeting re-schedule route
    Route::post('/reschedule-meeting', [EmployeeController::class, 'rescheduleMeeting'])->name('rescheduleMeeting');

    // Employee change password
    Route::get('/edit-password', [EmployeeController::class, 'editPassword'])->name('editPassword');
    Route::post('/update-password', [EmployeeController::class, 'updatePassword'])->name('updatePassword');
}); 


/* Backend Reception Routes */
Route::group(['middleware' => ['ReceptionMiddleware'], 'prefix' => '/reception', 'as' => 'reception.'], function() {
    // Dashboard page for visitor
    Route::get('/', [ReceptionController::class, 'dashboard'])->name('index');

    // Display reception Profile route
    Route::get('/profile', [ReceptionController::class, 'profile'])->name('profile');

    // Reception change password
    Route::get('/edit-password', [ReceptionController::class, 'editPassword'])->name('editPassword');
});



/* Backend Admin Panel Routes */
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {
    /* Admin Panel Login Route */
    Route::get('/', [AdminIndexController::class, 'login'])->name('login');

    Route::group(['middleware' => ['AdminMiddleware']], function() {
        /* Admin Panel Dashboard Route */
        Route::get('/dashboard', [AdminIndexController::class, 'index'])->name('index');

        /* Admin Panel Employee Routes */
        Route::get('/employees', [EmployeeManageController::class, 'index'])->name('employees');
        Route::get('/pending-employees', [EmployeeManageController::class, 'pending'])->name('pending.employees');
        Route::get('/approved-employees', [EmployeeManageController::class, 'approved'])->name('approved.employees');
        Route::get('/declined-employees', [EmployeeManageController::class, 'declined'])->name('declined.employees');

        Route::get('/approve-employee/{user_id}', [EmployeeManageController::class, 'approve'])->name('approve.employee');
        Route::get('/decline-employee/{user_id}', [EmployeeManageController::class, 'decline'])->name('decline.employee');

        /* Admin Panel Visitor Type Routes */
        Route::get('/visitorType/index', [VisitorTypeController::class, 'index'])->name('visitorType.index');
        Route::get('/visitorType/create', [VisitorTypeController::class, 'create'])->name('visitorType.create');
        Route::post('/visitorType/store', [VisitorTypeController::class, 'store'])->name('visitorType.store');
        Route::get('/visitorType/show/{id}', [VisitorTypeController::class, 'show'])->name('visitorType.show');
        Route::get('/visitorType/edit/{id}', [VisitorTypeController::class, 'edit'])->name('visitorType.edit');
        Route::patch('/visitorType/update/{id}', [VisitorTypeController::class, 'update'])->name('visitorType.update');
        Route::delete('/visitorType/destroy/{id}', [VisitorTypeController::class, 'destroy'])->name('visitorType.destroy');
    }); 
}); 