<?php

namespace App\Http\Controllers\AdditionalData;

use App\Model\Role;
use App\Model\Login;
use App\Model\DetailRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistenPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allAsisten()
    {
        $role = Role::orWhere('nama_role', 'Ketua Praktikum')->orWhere('nama_role', 'Asisten Praktikum')->select('id')->get();
        $detail_role = DetailRole::whereIn('id_role', $role->toArray())->select('id_login')->get();
        $asisten_praktikum = Login::whereIn('id', $detail_role->toArray())->get();

        return view('additional-data.asisten-praktikum.all-asisten-praktikum', compact('asisten_praktikum'));
    }
}
