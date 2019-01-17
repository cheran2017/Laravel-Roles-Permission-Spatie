<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(5);
        $data        = [ 'permissions' => $permissions ];
        return view('admin.views.permissions.permission')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.views.permissions.permission-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission         = new Permission;
        $permission->name   = $request->name;
        if ($permission->save()) {
            $request->session()->flash('alert-success', 'Permission created successfully!');
        } else {
            $request->session()->flash('alert-success', 'Permission create Failed!');
        }
        return redirect('permissions');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        $data        = [ 'permission' => $permission ];
        return view('admin.views.permissions.permission-edit')->with('data',$data);

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
        $permission         = Permission::find($id);
        $permission->name   = $request->name;
        if ($permission->save()) {
            $request->session()->flash('alert-success', 'Permission updated successfully!');
        } else {
            $request->session()->flash('alert-success', 'Permission updation Failed!');
        }
        return redirect('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $permission         = Permission::find($id);
        if ($permission->delete()) {
            $request->session()->flash('alert-success', 'Permission deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'Permission deletion Failed!');
        }
        return redirect('permissions');
    }
}
