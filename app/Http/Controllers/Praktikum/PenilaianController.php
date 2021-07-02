<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Penilaian;
use App\Model\Praktikum;
use Illuminate\Http\Request;
use App\Model\JenisPraktikum;
use App\Model\KelompokPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function allPenilaian()
    {
        $login = auth()->guard()->user();

        $praktikum_id = KelompokPraktikum::orWhere('id_asisten_praktikum', $login->id)->orWhere('id_peserta_praktikum', $login->id)->select('id_praktikum')->get();
        $penilaian = Penilaian::whereIn('id_praktikum', $praktikum_id->toArray())->get();

        $praktikum = Praktikum::where('nim_ketua_praktikum', $login->detailLogin->nim)->get();
        $jenis_praktikum = JenisPraktikum::get();
        
        $id_jenis_praktikum = Praktikum::where('nim_ketua_praktikum', $login->detailLogin->nim)->select('id_jenis_praktikum')->get();
        $nama_praktikum = JenisPraktikum::whereIn('id', $id_jenis_praktikum->toArray())->select('nama_praktikum')->get();

        return view('praktikum.penilaian.all-penilaian', compact('penilaian', 'praktikum', 'jenis_praktikum', 'nama_praktikum'));
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

        try {
            DB::beginTransaction();
                Penilaian::create([
                    'id_praktikum' => $request->praktikum,
                    'nama_penilaian' => $request->nama_penilaian,
                    'persentase_nilai' => $request->persentase_nilai,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Penilaian gagal ditambahkan');
        }
    }

    public function deletePenilaian($id)
    {
        try {
            DB::beginTransaction();
                Penilaian::where('id', $id)->delete();
            DB::commit();
            
            return redirect()->back()->with('success', 'Penilaian berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Penilaian gagal dihapus');
        }
    }
}
