<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use App\Models\Permission;
use App\Models\Role;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'permissions'       => Permission::count(),
            'permission_groups' => PermissionGroup::count(),
            'roles'             => Role::count(),
        ];
        return view('home')->with('data',$data);
    }
}
