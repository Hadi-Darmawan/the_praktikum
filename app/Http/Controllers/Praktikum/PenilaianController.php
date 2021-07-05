<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Nilai;
use App\Model\Penilaian;
use App\Model\Praktikum;
use App\Model\NilaiTotal;
use Illuminate\Http\Request;
use App\Model\KelompokPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allPenilaian()
    {
        $id_login = auth()->guard()->user()->id;
        $id_praktikum = KelompokPraktikum::orWhere('id_asisten_praktikum', $id_login)->orWhere('id_peserta_praktikum', $id_login)->select('id_praktikum')->get();
        $praktikum = Praktikum::whereIn('id', $id_praktikum->toArray())->get();

        return view('praktikum.penilaian.all-penilaian', compact('praktikum'));
    }

    public function detailPenilaian(Praktikum $praktikum)
    {        
        $penilaian = Penilaian::where('id_praktikum', $praktikum->id)->get();
        $peserta_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->where('id_asisten_praktikum', auth()->guard()->user()->id)->get();
        $nilai = Nilai::where('id_praktikum', $praktikum->id)->get();
        $nilai_total = NilaiTotal::where('id_praktikum', $praktikum->id)->get();

        return view('praktikum.penilaian.detail-penilaian', compact('praktikum', 'penilaian', 'peserta_praktikum', 'nilai', 'nilai_total'));
    }

    public function addPenilaian(Request $request, Praktikum $praktikum)
    {
        $this->validate($request,[
            'peserta_praktikum' => "required",
            'data_penilaian' => "required",
            'nilai' => "required|regex:/^[0-9.]+$/i",
        ],
        [
            'peserta_praktikum.required' => "Peserta praktikum wajib dipilih",
            'data_penilaian.required' => "Jenis penilaian wajib dipilih",
            'nilai.required' => "Nilai wajib diisi",
            'nilai.regex' => "Format nilai tidak sesuai",
        ]);

        $nilai = Nilai::where('id_login', $request->peserta_praktikum)->where('id_praktikum', $praktikum->id)->where('id_penilaian', $request->data_penilaian)->first();

        $persentase_nilai = Penilaian::where('id', $request->data_penilaian)->first();
        $nilai_total = NilaiTotal::where('id_praktikum', $praktikum->id)->where('id_login', $request->peserta_praktikum)->first();

        if ( $nilai_total != NULL ) {
            $nilai_awal = $nilai_total->nilai_total;
        } elseif ( $nilai_total == NULL ) {
            $nilai_awal = 0;
        }

        $nilai_akhir = ($request->nilai * ($persentase_nilai->persentase_nilai/100)) + $nilai_awal;

        if ($nilai_akhir >= 80) {
            $nilai_huruf = 'A';
        } elseif ($nilai_akhir >= 71) {
            $nilai_huruf = 'B+';
        } elseif ($nilai_akhir >= 65) {
            $nilai_huruf = 'B';
        } elseif ($nilai_akhir >= 60) {
            $nilai_huruf = 'C+';
        } elseif ($nilai_akhir >= 55) {
            $nilai_huruf = 'C';
        } elseif ($nilai_akhir >= 50) {
            $nilai_huruf = 'D+';
        } elseif ($nilai_akhir >= 40) {
            $nilai_akhir = 'D';
        } else {
            $nilai_huruf = 'E';
        }

        try {
            DB::beginTransaction();
                Nilai::where('id', $nilai->id)->update([
                    'nilai' => $request->nilai,
                ]);

                if ( $nilai_total != NULL ) {
                    NilaiTotal::where('id', $nilai_total->id)->update([
                        'nilai_total' => $nilai_akhir,
                        'nilai_huruf' => $nilai_huruf,
                    ]);
                } elseif ( $nilai_total == NULL ) {
                    NilaiTotal::create([
                        'id_praktikum' => $praktikum->id,
                        'id_login' => $request->peserta_praktikum,
                        'nilai_total' => $nilai_akhir,
                        'nilai_huruf' => $nilai_huruf,
                    ]);
                }
            DB::commit();
            
            return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return redirect()->back()->with('failed', 'Penilaian gagal ditambahkan');
        }
    }
}
