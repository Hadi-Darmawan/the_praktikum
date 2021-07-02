<?php

namespace App\Http\Controllers\Praktikum;

use App\Upload;
use App\Model\Praktikum;
use Illuminate\Http\Request;
use App\Model\ModulPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ModulPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadModul(Request $request, Praktikum $praktikum)
    {
        $filename = Upload::uploadFile($request->file('modul'), 'app/modul/');
        $modulname = $filename;

        try {
            DB::beginTransaction();
                ModulPraktikum::create([
                    'id_praktikum' => $praktikum->id,
                    'file_modul' => $modulname,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Modul praktikum berhasil diunggah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Modul praktikum gagal diunggah');
        }
    }

    public function downloadModul($id)
    {
        $modul_praktikum = ModulPraktikum::where('id', $id)->first();
        $modul = storage_path($modul_praktikum->file_modul);

        return response()->download($modul);
    }
}
