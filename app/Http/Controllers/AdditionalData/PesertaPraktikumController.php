<?php

namespace App\Http\Controllers\AdditionalData;

use App\Model\Role;
use App\Model\Login;
use App\Model\DetailRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesertaPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allPeserta()
    {
        $role = Role::where('nama_role', 'Anggota Praktikum')->select('id')->get();
        $detail_role = DetailRole::whereIn('id_role', $role->toArray())->select('id_login')->get();
        $peserta_praktikum = Login::whereIn('id', $detail_role->toArray())->get();

        return view('additional-data.peserta-praktikum.all-peserta-praktikum', compact('peserta_praktikum'));
    }
}
