@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Roles Permission</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Roles Permission</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="style-3" class="table style-3 table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No.</th>
                                            <th class="text-center">Role Name</th>
                                            <th class="text-center">Permissions</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rolePermissions as $rolePermission)
                                            <tr>
                                                <td class="text-center"> {{ $loop->index + 1 }} </td>
                                                
                                                @foreach ($rolePermission->user_types as $role)
                                                    <td class="text-center">
                                                        {{$role->user_type_name}}
                                                    </td>

                                                    <td class="text-center"> 
                                                        @foreach ($role->user_permissions as $user_permission)
                                                            @foreach ($user_permission->permissions as $permission)
                                                                <span class="inv-status badge badge-success">{{ $permission->permission_title }}</span> &nbsp; 
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                @endforeach

                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection