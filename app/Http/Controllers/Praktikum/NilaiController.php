<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Penilaian;
use App\Model\Praktikum;
use App\Model\NilaiTotal;
use Illuminate\Http\Request;
use App\Model\JenisPraktikum;
use App\Model\KelompokPraktikum;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataPraktikum()
    {
        $id_login = auth()->guard()->user()->id;
        $id_praktikum = KelompokPraktikum::orWhere('id_asisten_praktikum', $id_login)->orWhere('id_peserta_praktikum', $id_login)->select('id_praktikum')->get();
        $praktikum = Praktikum::whereIn('id', $id_praktikum->toArray())->get();

        return view('praktikum.nilai.data-praktikum', compact('praktikum'));
    }

    public function penilaian(Praktikum $praktikum)
    {
        // $asisten_praktikum = AsistenPraktikum::where('id_praktikum', $praktikum->id)->get();
        // $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->get();

        // $kelompok_praktikum = KelompokPraktikum::where('id_praktikum', $praktikum->id)->first();
        
        $penilaian = Penilaian::where('id_praktikum', $praktikum->id)->get();
        $nilai_total = NilaiTotal::where('id_praktikum', $praktikum->id)->get();

        return view('praktikum.nilai.penilaian', compact('praktikum', 'penilaian', 'nilai_total'));
    }
}
