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
use App\Http\Controllers\Backend\Admin\ReceptionManageController;
use App\Http\Controllers\Backend\Admin\VisitorTypeController;
use App\Http\Controllers\Backend\Admin\DepartmentController;
use App\Http\Controllers\Backend\Admin\DesignationController;
use App\Http\Controllers\Backend\Admin\VisitorManageController;
use App\Http\Controllers\Backend\Admin\AppointmentController;

/* Backend Ajax Controller */
use App\Http\Controllers\Backend\AjaxController;


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

    // Visitor routes
    Route::get('register', [IndexController::class, 'register'])->name('register');
    Route::post('user-register', [UserAuthController::class, 'userRegistration'])->name('user_registration');
    Route::get('user-verify/{user_id}', [UserAuthController::class, 'userVerify'])->name('user_verify');
    Route::post('/visitor', [UserAuthController::class, 'userLogin'])->name('user_login');
    Route::get('user-logout', [UserAuthController::class, 'userLogout'])->name('user_logout');

    /* Employee Routes */
    Route::get('employee/register', [IndexController::class, 'employeeCreate'])->name('employee.create');
    Route::post('employee/store', [EmployeeAuthController::class, 'store'])->name('employee.store');
    Route::post('employee/designations/{id}', [EmployeeAuthController::class, 'deptWiseDesignation'])->name('employee.designation');
    Route::post('/employee', [EmployeeAuthController::class, 'employeeLogin'])->name('employee.login');
}); 


/* Backend Visitor Routes */
Route::group(['middleware' => ['UserMiddleware'], 'prefix' => '/visitor', 'as' => 'visitor.'], function() {
    Route::get('/', [VisitorController::class, 'dashboard'])->name('index');
    Route::get('/profile', [VisitorController::class, 'profile'])->name('profile');
    Route::get('/edit-profile/{user_id}', [VisitorController::class, 'edit'])->name('editProfile');
    Route::post('/update-profile', [VisitorController::class, 'update'])->name('update-profile');
    Route::get('/make-an-appointment', [MeetingController::class, 'create'])->name('create');
    Route::post('/create-meeting', [MeetingController::class, 'store'])->name('store');
    Route::get('/search-employees', [MeetingController::class, 'searchEmployees'])->name('search-employees');
    Route::get('/all-appointments', [MeetingController::class, 'index'])->name('all_meetings');
    Route::get('/approved-meetings', [MeetingController::class, 'approved'])->name('approvedMeetings');
    Route::get('/pending-meetings', [MeetingController::class, 'pending'])->name('pendingaMeetings');
    Route::get('/reschedule-meeting', [MeetingController::class, 'reschedule'])->name('rescheduledMeetings');
    Route::get('/rejected-meetings', [MeetingController::class, 'rejected'])->name('rejectedMeetings');
    Route::post('/cancel-meeting', [MeetingController::class, 'cancelMeeting'])->name('cancel-meeting');
    Route::get('/visitor-pass/{meeting_id}', [MeetingController::class, 'visitorPass'])->name('visitorPass');
    Route::get('/gate-pass/{meeting_id}', [MeetingController::class, 'gate_pass'])->name('gatePass');
    Route::get('/get-host', [MeetingController::class, 'getHost'])->name('getHost');
    Route::post('/custom-report', [MeetingController::class, 'customReport'])->name('custom-report');
    Route::get('/edit-password', [VisitorController::class, 'editPassword'])->name('editPassword');
    Route::post('/update-password', [VisitorController::class, 'updatePassword'])->name('updatePassword');
}); 


/* Backend Employee Routes */
Route::group(['middleware' => ['EmployeeMiddleware'], 'prefix' => '/employee', 'as' => 'employee.'], function() {
    Route::get('/', [EmployeeController::class, 'dashboard'])->name('index');
    Route::post('/availability-status', [EmployeeController::class, 'availabilityStatus'])->name('availabilityStatus');
    Route::get('/all-meetings', [EmployeeController::class, 'allMeetings'])->name('allMeetings');
    Route::post('/custom-meeting-search', [EmployeeController::class, 'customMeetingSearch'])->name('customMeetingSearch');
    Route::get('/today-meetings', [EmployeeController::class, 'todayMeetings'])->name('todayMeetings');
    Route::get('/pending-meetings', [EmployeeController::class, 'pendingMeetings'])->name('pendingMeetings');
    Route::get('/approved-meetings', [EmployeeController::class, 'approvedMeetings'])->name('approvedMeetings');
    Route::get('/rescheduled-meetings', [EmployeeController::class, 'rescheduledMeetings'])->name('rescheduledMeetings');
    Route::get('/rejected-meetings', [EmployeeController::class, 'rejectedMeetings'])->name('rejectedMeetings');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');
    Route::get('/edit-profile/{user_id}', [EmployeeController::class, 'edit'])->name('editProfile');
    Route::post('/update-profile', [EmployeeController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/decline-meeting/{meeting_id}', [EmployeeController::class, 'declineMeeting'])->name('declineMeeting');
    Route::get('/approve-meeting/{meeting_id}', [EmployeeController::class, 'approveMeeting'])->name('approveMeeting');
    Route::post('/reschedule-meeting', [EmployeeController::class, 'rescheduleMeeting'])->name('rescheduleMeeting');
    Route::get('/edit-password', [EmployeeController::class, 'editPassword'])->name('editPassword');
    Route::post('/update-password', [EmployeeController::class, 'updatePassword'])->name('updatePassword');
}); 


/* Backend Reception Routes */
Route::group(['middleware' => ['ReceptionMiddleware'], 'prefix' => '/reception', 'as' => 'reception.'], function() {
    Route::get('/', [ReceptionController::class, 'dashboard'])->name('index');
    Route::get('/profile', [ReceptionController::class, 'profile'])->name('profile');
    Route::get('/edit-profile/{user_id}', [ReceptionController::class, 'edit'])->name('editProfile');
    Route::post('update-profile', [ReceptionController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/visitor-list', [ReceptionController::class, 'visitorList'])->name('visitorList');
    Route::post('/search-visitor', [ReceptionController::class, 'searchVisitor'])->name('searchVisitor');
    Route::get('/meeting-list', [ReceptionController::class, 'meetingList'])->name('meetingList');
    Route::post('/search-meeting', [ReceptionController::class, 'searchMeeting'])->name('searchMeeting');
    Route::get('/edit-password', [ReceptionController::class, 'editPassword'])->name('editPassword');
    Route::post('/update-password', [ReceptionController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/create-visitor-account', [ReceptionController::class, 'createVisitorAccount'])->name('createVisitorAccount');
    Route::post('/create-visitor-account', [ReceptionController::class, 'visitorRegister'])->name('visitorRegister');
    Route::get('/appoint-visitor', [ReceptionController::class, 'appointVisitor'])->name('appointVisitor');
    Route::get('/make-an-appointment/{visitor_id}', [ReceptionController::class, 'makeAnAppointment'])->name('makeAnAppointment');
    Route::get('/search-employees', [ReceptionController::class, 'searchEmployees'])->name('search-employees');
    Route::post('/place-an-appointment', [ReceptionController::class, 'placeAnAppointment'])->name('placeAnAppointment');
    Route::get('/visitor-profile/{visitor_id}', [ReceptionController::class, 'visitorProfile'])->name('visitorProfile');
    
});


/* Backend Admin Panel Routes */
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {

    /* Admin Panel Login Route */
    Route::get('/', [AdminIndexController::class, 'login'])->name('login');

    Route::group(['middleware' => ['AdminMiddleware']], function() {
        /* Admin Panel Dashboard Route */
        Route::get('/dashboard', [AdminIndexController::class, 'index'])->name('index');

        /* Admin Panel Host Routes */
        Route::get('/host', [EmployeeManageController::class, 'index'])->name('employee.index');
        Route::get('/host/create', [EmployeeManageController::class, 'create'])->name('employee.create');
        Route::post('/host/store', [EmployeeManageController::class, 'store'])->name('employee.store');
        Route::get('/host/show/{id}', [EmployeeManageController::class, 'show'])->name('employee.show');
        Route::get('/host/edit/{id}', [EmployeeManageController::class, 'edit'])->name('employee.edit');
        Route::get('/host/editPassword/{id}', [EmployeeManageController::class, 'editPassword'])->name('employee.editPassword');
        Route::patch('/host/update/{employee}', [EmployeeManageController::class, 'update'])->name('employee.update');
        Route::patch('/host/updatePassword/{id}', [EmployeeManageController::class, 'updatePassword'])->name('employee.updatePassword');
        Route::get('/host/destroy/{id}', [EmployeeManageController::class, 'destroy'])->name('employee.destroy');

        Route::get('/pending-host', [EmployeeManageController::class, 'pending'])->name('pending.employees');
        Route::get('/approved-host', [EmployeeManageController::class, 'approved'])->name('approved.employees');
        Route::get('/declined-host', [EmployeeManageController::class, 'declined'])->name('declined.employees');

        Route::get('/approve-host/{user_id}', [EmployeeManageController::class, 'approve'])->name('approve.employee');
        Route::get('/decline-host/{user_id}', [EmployeeManageController::class, 'decline'])->name('decline.employee');

        /* Admin Panel Receptionist Routes */
        Route::get('/reception', [ReceptionManageController::class, 'index'])->name('receptionist.index');
        Route::get('/reception/create', [ReceptionManageController::class, 'create'])->name('receptionist.create');
        Route::post('/reception/store', [ReceptionManageController::class, 'store'])->name('receptionist.store');
        Route::get('/reception/show/{id}', [ReceptionManageController::class, 'show'])->name('receptionist.show');
        Route::get('/reception/edit/{id}', [ReceptionManageController::class, 'edit'])->name('receptionist.edit');
        Route::get('/reception/editPassword/{id}', [ReceptionManageController::class, 'editPassword'])->name('receptionist.editPassword');
        Route::patch('/reception/update/{id}', [ReceptionManageController::class, 'update'])->name('receptionist.update');
        Route::patch('/reception/updatePassword/{id}', [ReceptionManageController::class, 'updatePassword'])->name('receptionist.updatePassword');
        Route::get('/reception/destroy/{id}', [ReceptionManageController::class, 'destroy'])->name('receptionist.destroy');

        Route::get('/pending-reception', [ReceptionManageController::class, 'pending'])->name('pending.receptionists');
        Route::get('/approved-reception', [ReceptionManageController::class, 'approved'])->name('approved.receptionists');
        Route::get('/declined-reception', [ReceptionManageController::class, 'declined'])->name('declined.receptionists');

        Route::get('/approve-reception/{user_id}', [ReceptionManageController::class, 'approve'])->name('approve.receptionist');
        Route::get('/decline-reception/{user_id}', [ReceptionManageController::class, 'decline'])->name('decline.receptionist');

        /* Admin Panel Visitor Routes */
        Route::get('/visitor', [VisitorManageController::class, 'index'])->name('visitor.index');
        Route::get('/visitor/show/{visitor_id}', [VisitorManageController::class, 'show'])->name('visitor.show');

        /* Admin Panel Appointment Routes */
        Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');

        Route::get('/appointment/approve/{meeting_id}', [AppointmentController::class, 'approve'])->name('approve.appointment');
        Route::get('/appointment/decline/{meeting_id}', [AppointmentController::class, 'decline'])->name('decline.appointment');
        Route::patch('/appointment/reschedule/{meeting_id}', [AppointmentController::class, 'reschedule'])->name('reschedule.appointment');
        Route::get('/appointment/cancel/{meeting_id}', [AppointmentController::class, 'cancel'])->name('cancel.appointment');

        Route::get('/appointment/search/{meeting_id}', [AppointmentController::class, 'search'])->name('search.appointment');

        /* Admin Panel Visitor Type Routes */
        Route::get('/visitorType/index', [VisitorTypeController::class, 'index'])->name('visitorType.index');
        Route::get('/visitorType/create', [VisitorTypeController::class, 'create'])->name('visitorType.create');
        Route::post('/visitorType/store', [VisitorTypeController::class, 'store'])->name('visitorType.store');
        Route::get('/visitorType/show/{id}', [VisitorTypeController::class, 'show'])->name('visitorType.show');
        Route::get('/visitorType/edit/{id}', [VisitorTypeController::class, 'edit'])->name('visitorType.edit');
        Route::patch('/visitorType/update/{id}', [VisitorTypeController::class, 'update'])->name('visitorType.update');
        Route::get('/visitorType/destroy/{id}', [VisitorTypeController::class, 'destroy'])->name('visitorType.destroy');

        /* Admin Panel Department Routes */
        Route::get('/department/index', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/department/show/{id}', [DepartmentController::class, 'show'])->name('department.show');
        Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::patch('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::get('/department/destroy/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

        /* Admin Panel Designation Routes */
        Route::get('/designation/index', [DesignationController::class, 'index'])->name('designation.index');
        Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create');
        Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
        Route::get('/designation/show/{id}', [DesignationController::class, 'show'])->name('designation.show');
        Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
        Route::patch('/designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
        Route::get('/designation/destroy/{id}', [DesignationController::class, 'destroy'])->name('designation.destroy');
    }); 
}); 


/* Backend Ajax Routes */
Route::post('backend/designations/{id}', [AjaxController::class, 'deptWiseDesignation'])->name('deptWiseDesignation');