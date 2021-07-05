<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Role;
use App\Model\Nilai;
use App\Model\Penilaian;
use App\Model\Praktikum;
use App\Model\DetailRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataPenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dataPenilaian()
    {
        $login = auth()->guard()->user();

        $role = Role::where('nama_role', 'Ketua Praktikum')->first();
        $praktikum_id = DetailRole::where('id_role', $role->id)->where('id_login', $login->id)->select('id_praktikum')->get();

        $penilaian = Penilaian::whereIn('id_praktikum', $praktikum_id->toArray())->get();
        $praktikum = Praktikum::where('nim_ketua_praktikum', $login->detailLogin->nim)->get();

        return view('praktikum.data-penilaian.data-penilaian', compact('penilaian', 'praktikum'));
    }

    public function storePenilaian(Request $request)
    {
        $this->validate($request,[
            'praktikum' => "required",
            'nama_penilaian' => "required|regex:/^[a-z0-9 ,.'-]+$/i|max:100",
            'persentase_nilai' => "required|numeric",
        ],
        [
            'praktikum.required' => "Praktikum wajib dipilih",
            'nama_penilaian.required' => "Nama penilaian wajib diisi",
            'nama_penilaian.regex' => "Format nama penilaian tidak sesuai",
            'persentase_nilai.required' => "Persentase penilaian wajib dipilih",
            'persentase_nilai.numeric' => "Persentase penilaian harus berupa angka",
        ]);

        $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $request->praktikum)->get();

        try {
            DB::beginTransaction();
                $penilaian = Penilaian::create([
                    'id_praktikum' => $request->praktikum,
                    'nama_penilaian' => $request->nama_penilaian,
                    'persentase_nilai' => $request->persentase_nilai,
                ]);

                foreach ($kelompok_praktikum as $data) {
                    Nilai::create([
                        'id_login' => $data->id_peserta_praktikum,
                        'id_praktikum' => $request->praktikum,
                        'id_penilaian' => $penilaian->id,
                        'nilai' => 0,
                    ]);
                }
            DB::commit();
            
            return redirect()->back()->with('success', 'Jenis penilaian berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Jenis penilaian gagal ditambahkan');
        }
    }

    public function deletePenilaian($id, Praktikum $praktikum)
    {
        try {
            DB::beginTransaction();
                Penilaian::where('id', $id)->delete();
            DB::commit();
            
            return redirect()->back()->with('success', 'Jenis penilaian berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Jenis penilaian gagal dihapus');
        }
    }
}
