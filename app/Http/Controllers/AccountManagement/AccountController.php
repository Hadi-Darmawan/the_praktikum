<?php

namespace App\Http\Controllers\AccountManagement;

use App\Model\Role;
use App\Model\Login;
use App\Model\DetailRole;
use App\Model\DetailLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accountData()
    {
        $login = Login::get();
        return view('account-management.all-account', compact('login'));
    }

    public function editAccount(Login $login)
    {
        $detail_role = DetailRole::where('id_login', auth()->guard()->user()->id)->get();
        return view('account-management.edit-account', compact('login', 'detail_role'));
    }

    public function updateAccount(Request $request ,Login $login)
    {
        if ($request->nim != $login->detailLogin->nim) {
            $this->validate($request,[
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
                'nim' => "required|unique:tb_detail_login,nim|numeric|digits:10",
            ],
            [
                'nama.required' => "Nama lengkap wajib diisi",
                'nama.regex' => "Forma nama tidak sesuai",
                'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
                'nim.required' => "NIM wajib diisi",
                'nim.unique' => "NIM tidak dapat digunakan",
                'nim.numeric' => "NIM harus berupa angka",
                'nim.digits' => "NIM harus berjumlah 10 angka",
            ]);
        } elseif ($request->nim == $login->detailLogin->nim) {
            $this->validate($request,[
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
                'nim' => "required|numeric|digits:10",
            ],
            [
                'nama.required' => "Nama lengkap wajib diisi",
                'nama.regex' => "Forma nama tidak sesuai",
                'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
                'nim.required' => "NIM wajib diisi",
                'nim.numeric' => "NIM harus berupa angka",
                'nim.digits' => "NIM harus berjumlah 10 angka",
            ]);
    
        }

        $nim = $request->nim;
        $thn_angkatan = str_split($nim, 2);
        $angkatan = $thn_angkatan[0];

        try {
            DB::beginTransaction();
                Login::where('id', $login->id)->update([
                    'username' => $request->nim
                ]);

                DetailLogin::where('id', $login->detailLogin->id)->update([
                    'nama' => $request->nama,
                    'nim' => $request->nim,
                    'angkatan' => $angkatan,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Data akun berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Data akun gagal diubah');
        }
    }

    public function accountStatus(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                Login::where('id', $id)->update([
                    'status' => $request->status
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Status akun berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Status akun gagal diubah');
        }
    }

    public function addAccount()
    {
        $role = Role::get();
        return view('account-management.add-account', compact('role'));
    }

    public function storeAccount(Request $request)
    {
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
            'nim' => "required|unique:tb_detail_login,nim|numeric|digits:10",
            'nomor_telepon' => "nullable|unique:tb_detail_login,nomor_telepon|numeric|digits_between:12-15",
            'username_telegram' => "nullable|unique:tb_detail_login,username_telegram|max:27",
            'line_id' => "nullable|unique:tb_detail_login,line_id|max:27",
            'jabatan' => "required",
            'role' => "required",
        ],
        [
            'nama.required' => "Nama lengkap wajib diisi",
            'nama.regex' => "Forma nama tidak sesuai",
            'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
            'nim.required' => "NIM wajib diisi",
            'nim.unique' => "NIM tidak dapat digunakan",
            'nim.numeric' => "NIM harus berupa angka",
            'nim.digits' => "NIM harus berjumlah 10 angka",
            'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
            'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
            'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username_telegram.unique' => "Username telegram tidak dapat digunakan",
            'username_telegram.max' => "Username telegram maksimal berjumlah 27 karakter",
            'line_id.unique' => "ID Line tidak dapat digunakan",
            'line_id.max' => "ID Line maksimal berjumlah 27 karakter",
            'jabatan.required' => "Jabatan wajib dipilih",
            'role.required' => "Role wajib dipilih",
        ]);

        $nim = $request->nim;
        $thn_angkatan = str_split($nim, 2);
        $angkatan = $thn_angkatan[0];

        try {
            DB::beginTransaction();
                $login = Login::create([
                    'username' => $request->nim,
                    'password' => bcrypt($request->nim),
                    'jabatan' => $request->jabatan,
                    'status' => 'Aktif',
                ]);

                DetailLogin::create([
                    'id_login' => $login->id,
                    'nama' => $request->nama,
                    'nim' => $request->nim,
                    'angkatan' => $angkatan,
                    'nomor_telepon' => $request->nomor_telepon,
                    'username_telegram' => $request->username_telegram,
                    'line_id' => $request->line_id,
                ]);

                foreach ($request->role as $data) {
                    DetailRole::create([
                        'id_login' => $login->id,
                        'id_role' => $data,
                    ]);
                }
            DB::commit();
            
            return redirect()->back()->with('success', 'Akun berhasil di daftarkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Akun gagal di daftarkan');
        }
    }
}
