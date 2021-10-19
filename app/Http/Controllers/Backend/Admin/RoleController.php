<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* included models */
use App\Models\UserType;
use App\Models\AdminLog;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = UserType::where('user_type_status', 0)
                            ->orWhere('user_type_status', 1)
                            ->get();

        return view('backend.pages.admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.admin.role.create');
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

        $role = UserType::create([
                            'user_type_name'=>$request->user_type_name,
                            'user_type_status'=>1,
                            'entry_user_id'=>$user_id,
                            'entry_datetime'=>now()
                ]);

        Session()->flash('success', 'Role Added Successfully !!!');
        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = UserType::where('user_type_id', $id)->first();

        return view('backend.pages.admin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = UserType::where('user_type_id', $id)->first();

        return view('backend.pages.admin.role.edit', compact('role'));
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

        $role = UserType::where('user_type_id', $id)
                                    ->update([
                                        'user_type_name'=>$request->user_type_name,
                                        'user_type_status'=>$request->user_type_status,
                                        'modified_user_id'=>$user_id,
                                        'modified_datetime'=>now()
                                    ]);

        Session()->flash('success' , 'Role Updated Successfully !!!');
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
