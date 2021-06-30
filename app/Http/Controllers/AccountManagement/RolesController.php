<?php

namespace App\Http\Controllers\AccountManagement;

use App\Model\Role;
use App\Model\Login;
use App\Model\DetailRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleJabatanData()
    {
        $login = Login::orderBy('username', 'asc')->get();
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

    public function updateAccountRoles(Request $request, Login $login)
    {
        $this->validate($request,[
            'role' => "required",
        ],
        [
            'role.required' => "Role wajib dipilih",
        ]);

        try {
            DB::beginTransaction();
                DetailRole::where('id_login', $login->id)->delete();

                foreach ($request->role as $data) {
                    DetailRole::create([
                        'id_login' => $login->id,
                        'id_role' => $data,
                    ]);
                }
            DB::commit();
            
            return redirect()->back()->with('success', 'Jabatan akun berhasil diperbaharui');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Jabatan akun gagal diperbaharui');
        }
    }
}
