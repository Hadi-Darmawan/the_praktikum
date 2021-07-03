<?php

namespace App\Http\Controllers\AccountManagement;

use App\Model\Role;
use App\Model\Login;
use App\Model\DetailRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleJabatanData()
    {
        $role_id = DetailRole::select('id_login')->get();
        $login = Login::whereIn('id', $role_id)->orderBy('username', 'asc')->get();

        $detail_role = DetailRole::get();

        return view('account-management.roles', compact('login', 'detail_role'));
    }

    public function editAccountRoles(Request $request, Login $login)
    {
        $detail_role = DetailRole::where('id_login', $login->id)->get();

        $id_role = DetailRole::where('id_login', $login->id)->select('id_role')->get();
        $role = Role::whereNotIn('id', $id_role->toArray())->get();

        return view('account-management.edit-account-roles', compact('login', 'role', 'detail_role'));
    }
}
