<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Praktikum;
use Illuminate\Http\Request;
use App\Model\AsistenPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AsistenPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeAsistenPraktikum(Request $request, Praktikum $praktikum)
    {
        $this->validate($request,[
            'asisten_praktikum.*' => "required",
        ],
        [
            'asisten_praktikum.required.*' => "Asisten praktikum wajib dipilih",
        ]);

        try {
            DB::beginTransaction();
                foreach ($request->asisten_praktikum as $data) {
                    AsistenPraktikum::create([
                        'id_login' => $data,
                        'id_praktikum' => $praktikum->id,
                    ]);
                }                
            DB::commit();
            
            return redirect()->back()->with('success', 'Asisten praktikum berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Asisten praktikum gagal ditambahkan');
        }
    }

    public function deleteAsistenPraktikum($id)
    {
        try {
            DB::beginTransaction();
                AsistenPraktikum::where('id', $id)->delete();
            DB::commit();
            
            return redirect()->back()->with('success', 'Asisten praktikum berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Asisten praktikum gagal dihapus');
        }
    }
}
