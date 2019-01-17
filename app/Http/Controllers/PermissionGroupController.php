<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = PermissionGroup::paginate(5);
        $data        = [ 'permissions_groups' => $permissions ];
        return view('admin.views.permission-groups.permission-group')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderby('name')->get();
        $data        = [ 'permissions' => $permissions ];
        return view('admin.views.permission-groups.permission-group-create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission_group                   = new PermissionGroup;
        $permission_group->name             = $request->name;
        $permission_group->permission_ids   = $request->permission_ids;
        if ($permission_group->save()) {
            $request->session()->flash('alert-success', 'Permission Group created successfully!');
        } else {
            $request->session()->flash('alert-success', 'Permission Group create Failed!');
        }
        return redirect('permissions-groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionGroup $permissionGroup,$id)
    {
        $permission_group = PermissionGroup::find($id);
        $permission_ids   = Permission::whereIn('id',$permission_group->permission_ids)->pluck('id')->toArray();
        $permissions      = Permission::orderby('name')->get();
        $data        = [ 'permission_group' => $permission_group,'permission_ids' => $permission_ids,'permissions' => $permissions ];
        return view('admin.views.permission-groups.permission-group-edit')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionGroup $permissionGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionGroup $permissionGroup,$id)
    {
        $permission_group                   = PermissionGroup::find($id);
        $permission_group->name             = $request->name;
        $permission_group->permission_ids   = $request->permission_ids;
        if ($permission_group->save()) {
            $request->session()->flash('alert-success', 'Permission Group updated successfully!');
        } else {
            $request->session()->flash('alert-success', 'Permission Group update Failed!');
        }
        return redirect('permissions-groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,PermissionGroup $permissionGroup,$id)
    {
        $permission_group         = PermissionGroup::find($id);
        if ($permission_group->delete()) {
            $request->session()->flash('alert-success', 'Permission Group deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'Permission Group deletion Failed!');
        }
        return redirect('permissions-groups');
    }
}
