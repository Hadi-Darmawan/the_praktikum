<?php

namespace App\Http\Controllers\Auth;

use App\Model\Login;
use App\Model\DetailRole;
use App\Model\DetailLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function registerApi(Request $request)
    {
        try {
            DB::beginTransaction();
                $login = Login::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'jabatan' => 'Kadiv Praktikum',
                ]);

                $detail_login = DetailLogin::create([
                    'id_login' => $login->id
                ]);

                $role = [1, 2];
        
                foreach ($role as $data) {
                    $detail_role = DetailRole::create([
                        'id_role' => $data,
                        'id_login' => $login->id,
                    ]);
                }
            DB::commit();

            return('Akun Berhasil Didaftarkan');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }    
    }
}
