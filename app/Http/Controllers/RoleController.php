<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionGroup;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','desc')->paginate(5);
        $data['roles'] = $roles;
        return view('admin.views.roles.role')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission_groups = PermissionGroup::all();
        $data    =  [ 'permission_groups' => $permission_groups ];
        return view('admin.views.roles.role-create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role         = new Role;
        $role->name   = $request->name;
        if ($role->save()) {
            if (isset($request->permission_groups_ids)) {
                if (count($request->permission_groups_ids) > 0 ) {
                    foreach ($request->permission_groups_ids as $key => $permission_groups_id) {
                        $permission_group = PermissionGroup::find($permission_groups_id);
                        if (!empty($permission_group)) {
                            if (count($permission_group->permission_ids) > 0) {
                                foreach ($permission_group->permission_ids as $key => $permission) {
                                    $permission = Permission::find($permission);
                                    $role->givePermissionTo($permission);
                                }
                            }
                        }
                    }
                }
            }
            $request->session()->flash('alert-success', 'Role created successfully!');
        } else {
            $request->session()->flash('alert-success', 'Role create Failed!');
        }
        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permission_groups = PermissionGroup::all();
        $permission_groups_ids = PermissionGroup::pluck('id')->toArray();
        $data        = [ 'role' => $role, 'permission_groups' => $permission_groups, 'permission_group_ids' => $permission_groups_ids ];
        return view('admin.views.roles.role-edit')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $role         = Role::find($id);
        $role->name   = $request->name;
        if ($role->save()) {
            $request->session()->flash('alert-success', 'Role updated successfully!');
        } else {
            $request->session()->flash('alert-success', 'Role update Failed!');
        }
        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $role         = Role::find($id);
        if ($role->delete()) {
            $request->session()->flash('alert-success', 'Role deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'Role deletion Failed!');
        }
        return redirect('roles');
    }
}
