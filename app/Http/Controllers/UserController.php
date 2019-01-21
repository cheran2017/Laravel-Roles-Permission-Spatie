<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::orderBy('id','desc')->paginate(5);
        $data       = [ 'users' => $users];
        return view('admin.views.users.users')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles   = Role::orderBy('name')->get();
        $data    =  [ 'roles' => $roles ];
        return view('admin.views.users.user-create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            if (!empty($request->role_id)) {
                $role = Role::find($request->role_id);
                $user->assignRole($role->name);
            }
            $request->session()->flash('alert-success', 'User created Successfully!');
        } else {
            $request->session()->flash('alert-danger', 'User create Failed!');
        }
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user   = User::find($id);
        $roles  = Role::orderBy('name')->get();
        $role_ids = Role::pluck('id')->toArray();
        $data        = [ 'user' => $user, 'roles' => $roles, 'role_ids' => $role_ids];
        return view('admin.views.users.user-edit')->with('data',$data);
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
        $user           = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'password' => 'required|confirmed',
            ]);
            $user->password = Hash::make($request->password);    
        }
        
        if ($user->save()) {
            if (!empty($request->role_id)) {
                $role = Role::find($request->role_id);
                $user->assignRole($role->name);
            }
            $request->session()->flash('alert-success', 'User Updated Successfully!');
        } else {
            $request->session()->flash('alert-danger', 'User update Failed!');
        }
        return redirect('users');
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
