<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Role;
use App\Model\Dosen;
use App\Model\Login;
use App\Model\Praktikum;
use App\Model\DetailRole;
use App\Model\DetailLogin;
use Illuminate\Http\Request;
use App\Model\JenisPraktikum;
use App\Model\ModulPraktikum;
use App\Model\AsistenPraktikum;
use App\Model\KelompokPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allPraktikum()
    {
        $praktikum = Praktikum::get();
        return view('praktikum.praktikum.all-praktikum', compact('praktikum'));
    }

    public function addPraktikum()
    {
        $jenis_praktikum = JenisPraktikum::whereNull('deleted_at')->get();
        $dosen = Dosen::where('status', 'Aktif')->get();

        $role_id = Role::where('nama_role', 'Ketua Praktikum')->select('id')->first();
        $login_id = DetailRole::whereIn('id_role', $role_id)->select('id_login')->get();
        $login = Login::where('status', 'Aktif')->whereIn('id', $login_id->toArray())->get();

        return view('praktikum.praktikum.add-praktikum', compact('jenis_praktikum', 'dosen', 'login'));
    }

    public function storePraktikum(Request $request)
    {
        $this->validate($request,[
            'jenis_praktikum' => "required",
            'dosen_pengampu' => "required",
            'ketua_praktikum' => "required",
            'tahun' => "required|digits:4",
        ],
        [
            'nama.required' => "Nama lengkap wajib diisi",
            'nama.regex' => "Format nama tidak sesuai",
            'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email valid",
            'email.unique' => "Email tidak dapat digunakan",
            'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
            'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
            'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username_telegram.unique' => "Username telegram tidak dapat digunakan",
            'username_telegram.max' => "Username telegram maksimal berjumlah 27 karakter",
        ]);

        $dosen = Dosen::where('id', $request->dosen_pengampu)->first();
        $dosen_pengampu = $dosen->nama;

        $detail_login = DetailLogin::where('id_login', $request->ketua_praktikum)->first();
        $ketua_praktikum = $detail_login->nama;

        try {
            DB::beginTransaction();
                $praktikum = Praktikum::create([
                    'id_jenis_praktikum' => $request->jenis_praktikum,
                    'dosen_pengampu' => $dosen_pengampu,
                    'ketua_praktikum' => $ketua_praktikum,
                    'tahun' => $request->tahun,
                ]);

                AsistenPraktikum::create([
                    'id_login' => $request->ketua_praktikum,
                    'id_praktikum' => $praktikum->id,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Praktikum berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Praktikum gagal ditambahkan');
        }
    }

    public function detailPraktikum(Praktikum $praktikum)
    {
        $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->get();

        # Data Praktikum
        $jenis_praktikum = JenisPraktikum::where('id', $praktikum->id_jenis_praktikum)->first();
        // $dosen = Dosen::where('status', 'Aktif')->get();
        // $role_id = Role::where('nama_role', 'Ketua Praktikum')->select('id')->first();
        // $login_id = DetailRole::whereIn('id_role', $role_id)->select('id_login')->get();
        // $login = Login::where('status', 'Aktif')->whereIn('id', $login_id->toArray())->get();

        # Modul Praktikum
        $modul_praktikum = ModulPraktikum::where('id_praktikum', $praktikum->id)->first();

        # Asisten Praktikum
        // $role_asisten_id = Role::orWhere('nama_role', 'Asisten Praktikum')->orWhere('nama_role', 'Ketua Praktikum')->select('id')->get();
        // $login_asisten_id = DetailRole::whereIn('id_role', $role_asisten_id->toArray())->select('id_login')->get();
        // $login_asisten = Login::where('status', 'Aktif')->whereIn('id', $login_asisten_id->toArray())->get();

        # Peserta Praktikum
        $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->get();
        // $role_peserta_id = Role::orWhere('nama_role', 'Anggota Praktikum')->select('id')->get();
        // $login_peserta_id = DetailRole::whereIn('id_role', $role_peserta_id->toArray())->select('id_login')->get();
        // $login_peserta = Login::where('status', 'Aktif')->whereIn('id', $login_peserta_id->toArray())->get();

        return view('praktikum.praktikum.detail-praktikum', compact('praktikum', 'asisten_praktikum', 'jenis_praktikum', 'modul_praktikum', 'kelompok_praktikum'));
    }

    public function editPraktikum(Praktikum $praktikum)
    {
        $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->get();

        # Data Praktikum
        $jenis_praktikum = JenisPraktikum::whereNull('deleted_at')->get();
        $dosen = Dosen::where('status', 'Aktif')->get();
        $role_id = Role::where('nama_role', 'Ketua Praktikum')->select('id')->first();
        $login_id = DetailRole::whereIn('id_role', $role_id)->select('id_login')->get();
        $login = Login::where('status', 'Aktif')->whereIn('id', $login_id->toArray())->get();

        # Modul Praktikum
        $modul_praktikum = ModulPraktikum::where('id_praktikum', $praktikum->id)->first();

        # Asisten Praktikum
        $role_asisten_id = Role::orWhere('nama_role', 'Asisten Praktikum')->orWhere('nama_role', 'Ketua Praktikum')->select('id')->get();
        $login_asisten_id = DetailRole::whereIn('id_role', $role_asisten_id->toArray())->select('id_login')->get();
        $asisten_praktikum_id = AsistenPraktikum::where('id_praktikum', $praktikum->id)->select('id_login')->get();
        $login_asisten = Login::where('status', 'Aktif')->whereIn('id', $login_asisten_id->toArray())->whereNotIn('id', $asisten_praktikum_id->toArray())->get();

        # Peserta Praktikum
        $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->get();
        $role_peserta_id = Role::orWhere('nama_role', 'Anggota Praktikum')->select('id')->get();
        $login_peserta_id = DetailRole::whereIn('id_role', $role_peserta_id->toArray())->select('id_login')->get();
        $peserta_praktikum_id = KelompokPraktikum::where('id_praktikum', $praktikum->id)->select('id_peserta_praktikum')->get();
        $login_peserta = Login::where('status', 'Aktif')->whereIn('id', $login_peserta_id->toArray())->whereNotIn('id', $peserta_praktikum_id->toArray())->get();

        return view('praktikum.praktikum.edit-praktikum', compact('praktikum', 'asisten_praktikum', 'jenis_praktikum', 'dosen', 'login', 'modul_praktikum', 'login_asisten', 'kelompok_praktikum', 'login_peserta'));
    }

    public function updatePraktikum(Request $request, Praktikum $praktikum)
    {
        $this->validate($request,[
            'jenis_praktikum' => "required",
            'dosen_pengampu' => "required",
            'ketua_praktikum' => "required",
            'tahun' => "required|digits:4",
        ],
        [
            'nama.required' => "Nama lengkap wajib diisi",
            'nama.regex' => "Format nama tidak sesuai",
            'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email valid",
            'email.unique' => "Email tidak dapat digunakan",
            'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
            'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
            'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username_telegram.unique' => "Username telegram tidak dapat digunakan",
            'username_telegram.max' => "Username telegram maksimal berjumlah 27 karakter",
        ]);

        $dosen = Dosen::where('id', $request->dosen_pengampu)->first();
        $dosen_pengampu = $dosen->nama;

        $detail_login = DetailLogin::where('id_login', $request->ketua_praktikum)->first();
        $ketua_praktikum = $detail_login->nama;

        $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->first();

        try {
            DB::beginTransaction();
                Praktikum::where('id', $praktikum->id)->update([
                    'id_jenis_praktikum' => $request->jenis_praktikum,
                    'dosen_pengampu' => $dosen_pengampu,
                    'ketua_praktikum' => $ketua_praktikum,
                    'tahun' => $request->tahun,
                ]);

                AsistenPraktikum::where('id', $asisten_praktikum->id)->update([
                    'id_login' => $request->ketua_praktikum,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Data praktikum berhasil diperbaharui');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Data praktikum gagal diperbaharui');
        }
    }
}
