<?php

namespace App\Http\Controllers\Praktikum;

use App\Model\Praktikum;
use Illuminate\Http\Request;
use App\Model\KelompokPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnggotaPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeAnggotaPraktikum(Request $request, Praktikum $praktikum)
    {
        $this->validate($request,[
            'peserta_praktikum.*' => "required",
        ],
        [
            'peserta_praktikum.required.*' => "Peserta praktikum wajib dipilih",
        ]);

        try {
            DB::beginTransaction();
                foreach ($request->peserta_praktikum as $data) {
                    KelompokPraktikum::create([
                        'id_praktikum' => $praktikum->id,
                        'id_asisten_praktikum' => $request->asisten_praktikum,
                        'id_peserta_praktikum' => $data,
                        'kelompok' => $request->kelompok
                    ]);
                }                
            DB::commit();
            
            return redirect()->back()->with('success', 'Peserta praktikum berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Peserta praktikum gagal ditambahkan');
        }
    }

    public function deleteAnggotaPraktikum($id)
    {
        try {
            DB::beginTransaction();
                KelompokPraktikum::where('id', $id)->delete();
            DB::commit();
            
            return redirect()->back()->with('success', 'Peserta praktikum berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Peserta praktikum gagal dihapus');
        }
    }
}
