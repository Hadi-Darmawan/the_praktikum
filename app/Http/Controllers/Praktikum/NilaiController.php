<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Role;
use App\Model\Nilai;
use App\Model\Penilaian;
use App\Model\Praktikum;
use App\Model\DetailRole;
use App\Model\NilaiTotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allPenilaian()
    {
        $login_id = auth()->guard()->user()->id;

        $role = Role::where('nama_role', 'Anggota Praktikum')->first();
        $user_praktikum_id = DetailRole::where('id_login', $login_id)->where('id_role', $role->id)->select('id_praktikum')->get();
        
        $praktikum = Praktikum::whereIn('id', $user_praktikum_id->toArray())->get();

        return view('praktikum.nilai.all-nilai', compact('praktikum'));
    }

    public function detailNilai(Praktikum $praktikum)
    {
        $login_id = auth()->guard()->user()->id;

        $penilaian = Penilaian::where('id_praktikum', $praktikum->id)->get();
        $nilai = Nilai::where('id_login', $login_id)->where('id_praktikum', $praktikum->id)->get();
        $nilai_total = NilaiTotal::where('id_login', $login_id)->where('id_praktikum', $praktikum->id)->get();

        return view('praktikum.nilai.detail-nilai', compact('praktikum', 'penilaian', 'nilai', 'nilai_total'));
    }
}
