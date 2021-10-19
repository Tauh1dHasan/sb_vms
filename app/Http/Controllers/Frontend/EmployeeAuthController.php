<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Auth;
use Response;

/* included models */
use App\Models\User;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Designation;
use App\Models\Department;

class EmployeeAuthController extends Controller
{
    /**
     * Department Wise Designation.
     */
    public function deptWiseDesignation(Request $request, $id){
        $data = $request->dept_id;

        if ($id == 2) {
            $designations = Designation::where('designations.dept_id', $data)
                                        ->where('designations.slug', '!=', "receptionist")
                                        ->select('designation_id', 'designation')
                                        ->get();
        }

        if ($id == 3) {
            $designations = Designation::where('designations.dept_id', $data)
                                        ->where('designations.slug', "receptionist")
                                        ->select('designation_id', 'designation')
                                        ->get();
        }
       

        return Response::json($designations);
    }

    /**
     * Employee Registration Method.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $user = new User;

        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = $request->user_type_id;
        $user->entry_datetime = now();

        $user->save();

        $employee = new Employee;

        $employee->user_id = $user->user_id;
        $employee->user_type_id = $request->user_type_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->eid_no = $request->eid_no;
        $employee->dept_id = $request->dept_id;
        $employee->designation_id = $request->designation_id;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->mobile_no = $request->mobile_no;
        $employee->email = $request->email;
        $employee->start_hour = $request->start_hour;
        $employee->end_hour = $request->end_hour;
        $employee->building_no = $request->building_no;
        $employee->gate_no = $request->gate_no;
        $employee->elevator_no = $request->elevator_no;
        $employee->floor_no = $request->floor_no;
        $employee->room_no = $request->room_no;
        $employee->address = $request->address;
        $employee->nid_no = $request->nid_no;
        $employee->passport_no = $request->passport_no;
        $employee->driving_license_no = $request->driving_license_no;
        $employee->slug = strtolower($request->first_name.'-'.$request->last_name);
        $employee->entry_datetime = now();

        $employee->photo = $request->photo;
        
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imgName = 'employee'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('backend/img/employees/'.$imgName);
            Image::make($image)->save($location);

            $employee->photo = $imgName;
        }

        $employee->save();

        Session()->flash('success' , 'Registration Successfull! Account approval will be notified by email.');
        return redirect()->route('index');
    }

    /**
     * Employee Registration validation.
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'user_type_id' => 'required',
            'dept_id' => 'required',
            'designation_id' => 'required',
            'eid_no' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'mobile_no' => 'required|unique:users|min:11',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'photo' => 'mimes:jpeg,png,jpg|max:2048',
            '_answer'=>'required|simple_captcha',
        ]);
    }
}
