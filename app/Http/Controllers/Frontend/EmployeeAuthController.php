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

/* included */
use App\Models\User;
use App\Models\Employee;
use App\Models\Visitor;

class EmployeeAuthController extends Controller
{
    /**
     * Department Wise Designation.
     *
     * @return \Illuminate\Http\Response
     */
    public function dept_wise_designation(Request $request){
        $data = $request->all();

        $designations = DB::table('designations')
        ->where('designations.dept_id', '=', $data['dept_id'])
        ->select('designation_id','designation')
        ->get();

        return Response::json($designations);
    }

    /**
     * Employee Registration Method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $user = new User;

        $user->username = $request->mobile_no;
        $user->password = bcrypt($request->password);
        $user->user_type_id = $request->user_type_id;
        $user->entry_datetime = now();

        $user->save();

        $user_id = User::orderBy('user_id', 'desc')->first();

        $employee = new Employee;

        $employee->user_id = $user_id->user_id;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'user_type_id' => 'required',
            'dept_id' => 'required',
            'designation_id' => 'required',
            'mobile_no' => 'required|unique:employees|min:11',
            'password' => 'required|confirmed|min:6|max:255',
            // 'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'photo' => 'mimes:jpeg,png,jpg|max:2048',
            '_answer'=>'required|simple_captcha',
        ]);
    }

    /**
     * Employee Login Method.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_login(Request $request)
    {
        
        $request->validate([
            'username' => 'required|min:11',
            'password' => 'required|max:255',
        ]);

    
        $user = DB::table('users')
                ->where([
                    ['username', '=', $request->username],
                    ['user_type_id', '=', '2'],])
                ->first();

        if(!empty($user)){
            
            $password = Hash::check($request->password, $user->password);

            if($password)
            {
                Session::put(['loggedUser' => $user->user_id, 'loggedUserType' => $user->user_type_id]);
                return view('backend.index');
            }
            else{
                Session()->flash('sticky_error' , 'Username & Password didnot matched!');
                return redirect()->back();
            }
        }
        else {
            Session()->flash('sticky_error' , 'No authorised employee found by this username!');
            return redirect()->back();
        }
    }

    /**
     * User Login method.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_logout(Request $request) {
        // Auth::logout();
        if(session()->has('loggedUser')){
            Session::flush();
            return redirect('/');
        }
    }
}
