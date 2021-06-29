<?php

namespace App\Http\Controllers\Auth;

use App\Model\Login;
use App\Model\DetailRole;
use App\Model\DetailLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $detail_role = DetailRole::where('id_login', auth()->guard()->user()->id)->get();
        return view('auth.profile.profile', compact('detail_role'));
    }

    public function updateAccount(Request $request, DetailLogin $detailLogin)
    {
        if ($request->nomor_telepon != $detailLogin->nomor_telepon) {
            $this->validate($request,[
                'nomor_telepon' => "nullable|numeric|unique:tb_detail_login,nomor_telepon|digits_between:12,15",
            ],
            [
                'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
                'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
                'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 nomor",
            ]);
        }

        if ($request->username_telegram != $detailLogin->username_telegram) {
            $this->validate($request,[
                'username_telegram' => "nullable|unique:tb_detail_login,username_telegram|max:27",
            ],
            [
                'username_telegram.unique' => "Username telegram tidak dapat digunakan",
                'username_telegram.max' => "Username telegram terlalu panjang. Maksimal 27 karakter",
            ]);
        }

        if ($request->line_id != $detailLogin->line_id) {
            $this->validate($request,[
                'line_id' => "nullable|unique:tb_detail_login,line_id|max:27",
            ],
            [
                'line_id.unique' => "ID Line tidak dapat digunakan",
                'line_id.max' => "ID Line terlalu panjang. Maksimal 27 karakter",
            ]);
        }

        try {
            DB::beginTransaction();
                $update_account = DetailLogin::where('id', $detailLogin->id)->update([
                    'nomor_telepon' => $request->nomor_telepon,
                    'username_telegram' => $request->username_telegram,
                    'line_id' => $request->line_id,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Data akun anda berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            // throw $th;
            return redirect()->back()->with('failed', 'Data akun anda gagal diubah');
        }
    }

    public function changePassword(Request $request, Login $login)
    {
        $this->validate($request,[
            'password_lama' => "required|min:8",
            'password' => "required|confirmed|min:8",
        ],
        [
            'password_lama.required' => "Password lama wajib diisi",
            'password_lama.min' => "Password lama minimal berjumlah 8 karakter",
            'password.required' => "Password baru wajib diisi",
            'password.confirmed' => "Konfirmasi password baru tidak sesuai",
            'password.min' => "Password lama minimal berjumlah 8 karakter",
        ]);

        if (Hash::check($request->password_lama, $login->password)) {
            try {
                DB::beginTransaction();
                    $update_password = Login::where('id', $login->id)->update([
                        'password' => bcrypt($request->password)
                    ]);
                DB::commit();
                
                return redirect()->back()->with('success', 'Password anda berhasil diubah');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('failed', 'Password anda gagal diubah');
            }
        } else {
            return redirect()->back()->with('error', 'Password lama anda tidak sesuai');
        }
    }
}
