<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* included models */
use App\Models\Permission;
use App\Models\UserType;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolePermissions = UserPermission::with('user_types', 'permissions')
                                            ->where('user_permission_status', 1)
                                            ->distinct('user_type_id')
                                            ->get('user_type_id');

        // dd($rolePermissions);

        return view('backend.pages.admin.rolePermission.index', compact('rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UserType::where([
                                ['user_type_status' , '=', '1'],
                                ['user_type_id' , '=', '2'],
                            ])
                            ->orWhere([
                                ['user_type_status' , '=', '1'],
                                ['user_type_id' , '=', '3'],
                            ])
                            ->get();

        $permissions = Permission::where('permission_status', 1)->get();

        return view('backend.pages.admin.rolePermission.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (count($request->permission_id) > 0) {
            foreach ($request->permission_id as $permission_id) {
                $rolePermission = UserPermission::create([
                                                    'user_type_id'=>$request->user_type_id,
                                                    'permission_id'=>$permission_id
                                                ]);

            }
        }

        Session()->flash('success' , 'Permissions Added to Role Successfully !!!');
        return redirect()->route('admin.userPermission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolePermission = UserPermission::with('user_type', 'permissions')->where('user_permission_id', $id)->first();

        return view('backend.pages.admin.rolePermission.edit', compact('rolePermission'));
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
        if (count($request->permission_id) > 0) {
            foreach ($request->permission_id as $permission_id) {
                $rolePermission = UserPermission::where('user_permission_id', $id)
                                                ->update([
                                                    'user_type_id'=>$request->user_type_id,
                                                    'permission_id'=>$permission_id
                                                ]);

            }
        }
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
