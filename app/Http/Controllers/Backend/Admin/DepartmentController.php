<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

/* included models */
use App\Models\Department;
use App\Models\AdminLog;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('status', 0)
                                ->orWhere('status', 1)
                                ->get();

        return view('backend.pages.admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.admin.department.create');
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

        $department = Department::create([
                                    'department_name'=>$request->department_name,
                                    'slug'=>Str::slug($request->department_name),
                                    'entry_user_id'=>$user_id,
                                    'entry_datetime'=>now()
                                ]);

        $department_id = Department::orderBy('dept_id', 'desc')->first();

        $admin_log = AdminLog::create([
                                    'log_type'=>1,
                                    'description'=>'Create Department',
                                    'dept_id'=>$department_id->dept_id,
                                    'department_name'=>$request->department_name,
                                    'department_status'=>$request->status,
                                    'entry_user_id'=>$user_id,
                                    'entry_datetime'=>now()
                                ]);

        Session()->flash('success' , 'Department Added Successfully !!!');
        return redirect()->route('admin.department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::where('dept_id', $id)->first();

        return view('backend.pages.admin.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::where('dept_id', $id)->first();

        return view('backend.pages.admin.department.edit', compact('department'));
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

        $old_department = Department::where('dept_id', $id)->first();

        $department = Department::where('dept_id', $id)
                                ->update([
                                            'department_name'=>$request->department_name,
                                            'slug'=>Str::slug($request->department_name),
                                            'status'=>$request->status,
                                            'modified_user_id'=>$user_id,
                                            'modified_datetime'=>now()
                                        ]);

        $admin_log = AdminLog::create([
                                        'log_type'=>2,
                                        'description'=>'Update Department',
                                        'dept_id'=>$old_department->dept_id,
                                        'department_name'=>$old_department->department_name,
                                        'department_status'=>$old_department->status,
                                        'entry_user_id'=>$user_id,
                                        'entry_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Department Updated Successfully !!!');
        return redirect()->route('admin.department.index');
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

        $old_department = Department::where('dept_id', $id)->first();
        
        $department = Department::where('dept_id', $id)
                                    ->update([
                                        'status'=>2,
                                        'modified_user_id'=>$user_id,
                                        'modified_datetime'=>now()
                                    ]);
        
        $admin_log = AdminLog::create([
                                        'log_type'=>3,
                                        'description'=>'Delete Department',
                                        'dept_id'=>$old_department->dept_id,
                                        'department_name'=>$old_department->department_name,
                                        'department_status'=>$old_department->status,
                                        'entry_user_id'=>$user_id,
                                        'entry_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Department Deleted Successfully !!!');
        return redirect()->route('admin.department.index');
    }
}
