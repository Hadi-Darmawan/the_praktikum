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
        $id_login = auth()->guard()->user()->id; #Select id user yg login

        # Cek Administrator
        $administrator = Role::orWhere('nama_role', 'Administrator')->first();
        $check_role = DetailRole::where('id_login', $id_login)->where('id_role', $administrator->id)->get();
        
        if (count($check_role) > 0) { # True is administrator
            $praktikum = Praktikum::get(); #Select semua praktikum
        } elseif (count($check_role) < 1) { # Trus is not super admin
            $role_id = Role::orWhere('nama_role', 'Ketua Praktikum')->select('id')->get(); #Select id role yang rolenya ketua & asisten Praktikum
            $id_praktikum = DetailRole::whereIn('id_role', $role_id->toArray())->where('id_login', $id_login)->select('id_praktikum')->get(); #Select id praktikum dari tb_detail_role berdasarkan id role yang dipilih sebelumya
            $praktikum = Praktikum::whereIn('id', $id_praktikum->toArray())->get(); #Select praktikum berdasarkan id_praktikum yang dipilih sebelumnya
        }
        

        return view('praktikum.praktikum.all-praktikum', compact('praktikum'));
    }

    public function addPraktikum()
    {
        $jenis_praktikum = JenisPraktikum::whereNull('deleted_at')->get();
        $dosen = Dosen::where('status', 'Aktif')->get();
        $login = Login::where('status', 'Aktif')->get();

        return view('praktikum.praktikum.add-praktikum', compact('jenis_praktikum', 'dosen', 'login'));
    }

    public function storePraktikum(Request $request)
    {
        $this->validate($request,[
            'jenis_praktikum' => "required",
            'dosen_pengampu' => "required",
            'ketua_praktikum' => "required",
            'tahun' => "required|numeric|digits:4",
        ],
        [
            'jenis_praktikum.required' => "Jenis praktikum wajib dipilih",
            'dosen_pengampu.required' => "Dosen pengampu wajib dipilih",
            'ketua_praktikum.required' => "Ketua praktikum wajib dipilih",
            'tahun.required' => "Tahun praktikum wajib diisi",
            'tahun.required' => "Tahun praktikum harus berupa angka",
            'tahun.required' => "Tahun praktikum harus tahun yang valid",
        ]);

        $dosen = Dosen::where('id', $request->dosen_pengampu)->first();
        $detail_login = DetailLogin::where('id_login', $request->ketua_praktikum)->first();
        $role = Role::where('nama_role', 'Ketua Praktikum')->first();

        try {
            DB::beginTransaction();
                $praktikum = Praktikum::create([
                    'id_jenis_praktikum' => $request->jenis_praktikum,
                    'dosen_pengampu' => $dosen->nama,
                    'ketua_praktikum' => $detail_login->nama,
                    'nim_ketua_praktikum' => $detail_login->nim,
                    'tahun' => $request->tahun,
                ]);

                AsistenPraktikum::create([
                    'id_login' => $request->ketua_praktikum,
                    'id_praktikum' => $praktikum->id,
                ]);

                DetailRole::create([
                    'id_role' => $role->id,
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
        # Global
        $role_ketua_asisten_id = Role::orWhere('nama_role', 'Asisten Praktikum')->orWhere('nama_role', 'Ketua Praktikum')->select('id')->get();
        $ketua_asisten_id = DetailRole::whereIn('id_role', $role_ketua_asisten_id->toArray())->where('id_praktikum', $praktikum->id)->select('id_login')->get();
        $anggota_praktikum_id = KelompokPraktikum::where('id_praktikum', $praktikum->id)->select('id_peserta_praktikum')->get();

        # Asisten Praktikum
        $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->get();
        $login_asisten = Login::whereNotIn('id', $ketua_asisten_id->toArray())->whereNotIn('id', $anggota_praktikum_id)->where('status', 'Aktif')->get();

        # Peserta Praktikum
        $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->get();
        $login_peserta = Login::whereNotIn('id', $ketua_asisten_id->toArray())->whereNotIn('id', $anggota_praktikum_id)->where('status', 'Aktif')->get();

        return view('praktikum.praktikum.detail-praktikum', compact('praktikum', 'asisten_praktikum', 'login_asisten', 'kelompok_praktikum', 'login_peserta'));
    }

    public function editPraktikum(Praktikum $praktikum)
    {
        $jenis_praktikum = JenisPraktikum::whereNull('deleted_at')->get();
        $dosen = Dosen::where('status', 'Aktif')->get();
        $login = Login::where('status', 'Aktif')->get();

        return view('praktikum.praktikum.edit-praktikum', compact('praktikum', 'jenis_praktikum', 'dosen', 'login'));
    }

    public function updatePraktikum(Request $request, Praktikum $praktikum)
    {
        $this->validate($request,[
            'jenis_praktikum' => "required",
            'dosen_pengampu' => "required",
            'ketua_praktikum' => "required",
            'tahun' => "required|numeric|digits:4",
        ],
        [
            'jenis_praktikum.required' => "Jenis praktikum wajib dipilih",
            'dosen_pengampu.required' => "Dosen pengampu wajib dipilih",
            'ketua_praktikum.required' => "Ketua praktikum wajib dipilih",
            'tahun.required' => "Tahun praktikum wajib diisi",
            'tahun.numeric' => "Format tahun praktikum tidak sesuai",
            'tahun.digit' => "Masukan format tahun yang valid",
        ]);

        $dosen = Dosen::where('id', $request->dosen_pengampu)->first();
        $detail_login = DetailLogin::where('id_login', $request->ketua_praktikum)->first();
        $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->first();
        $role = Role::where('nama_role', 'Ketua Praktikum')->first();
        $ketua_praktikum_lama = DetailLogin::where('nim', $praktikum->nim_ketua_praktikum)->first();
        $detail_role = DetailRole::where('id_role', $role->id)->where('id_login', $ketua_praktikum_lama->id_login)->where('id_praktikum', $praktikum->id)->first();

        try {
            DB::beginTransaction();
                DetailRole::where('id', $detail_role->id)->delete();

                Praktikum::where('id', $praktikum->id)->update([
                    'id_jenis_praktikum' => $request->jenis_praktikum,
                    'dosen_pengampu' => $dosen->nama,
                    'ketua_praktikum' => $detail_login->nama,
                    'tahun' => $request->tahun,
                ]);

                DetailRole::create([
                    'id_role' => $role->id,
                    'id_login' => $request->ketua_praktikum,
                    'id_praktikum' => $praktikum->id,
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
