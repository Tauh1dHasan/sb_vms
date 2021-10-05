<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

/* included models */
use App\Models\Designation;
use App\Models\Department;
use App\Models\AdminLog;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::with('department')
                                    ->where('status', 0)
                                    ->orWhere('status', 1)
                                    ->get();

        return view('backend.pages.admin.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get();

        return view('backend.pages.admin.designation.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = session('loggedUser');

        $designation = Designation::create([
                                    'designation'=>$request->designation,
                                    'slug'=>Str::slug($request->designation),
                                    'dept_id'=>$request->dept_id,
                                    'entry_user_id'=>$user_id,
                                    'entry_datetime'=>now()
                                ]);

        $designation_id = Designation::orderBy('designation_id', 'desc')->first();

        $admin_log = AdminLog::create([
                                    'log_type'=>1,
                                    'description'=>'Create Desigantion',
                                    'designation_id'=>$designation_id->designation_id,
                                    'designation'=>$request->designation,
                                    'designation_dept_id'=>$request->dept_id,
                                    'designation_status'=>1,
                                    'log_type'=>1,
                                    'entry_user_id'=>$user_id,
                                    'entry_datetime'=>now()
                                ]);

        Session()->flash('success' , 'Designation Added Successfully !!!');
        return redirect()->route('admin.designation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $designation = Designation::with('department')
                                    ->where('designation_id', $id)
                                    ->first();

        return view('backend.pages.admin.designation.show', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::where('status', 1)->get();

        $designation = Designation::with('department')
                                    ->where('designation_id', $id)
                                    ->first();

        return view('backend.pages.admin.designation.edit', compact( 'departments', 'designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = session('loggedUser');

        $old_designation = Designation::where('designation_id', $id)->first();

        $designation = Designation::where('designation_id', $id)
                                    ->update([
                                        'designation'=>$request->designation,
                                        'slug'=>Str::slug($request->designation),
                                        'dept_id'=>$request->dept_id,
                                        'status'=>$request->status,
                                        'modified_user_id'=>$user_id,
                                        'modified_datetime'=>now()
                                    ]);

        $admin_log = AdminLog::create([
                                        'log_type'=>2,
                                        'description'=>'Update Designation',
                                        'designation_id'=>$old_designation->designation_id,
                                        'designation'=>$old_designation->designation,
                                        'designation_dept_id'=>$old_designation->dept_id,
                                        'designation_status'=>$old_designation->status,
                                        'entry_user_id'=>$user_id,
                                        'entry_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Designation Updated Successfully !!!');
        return redirect()->route('admin.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = session('loggedUser');

        $old_designation = Designation::where('designation_id', $id)->first();
        
        $designation = Designation::where('designation_id', $id)
                                    ->update([
                                        'status'=>2,
                                        'modified_user_id'=>$user_id,
                                        'modified_datetime'=>now()
                                    ]);

        $admin_log = AdminLog::create([
                                        'log_type'=>3,
                                        'description'=>'Delete Designation',
                                        'designation_id'=>$old_designation->designation_id,
                                        'designation'=>$old_designation->designation,
                                        'designation_dept_id'=>$old_designation->dept_id,
                                        'designation_status'=>$old_designation->status,
                                        'entry_user_id'=>$user_id,
                                        'entry_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Designation Deleted Successfully !!!');
        return redirect()->route('admin.designation.index');
    }
}
