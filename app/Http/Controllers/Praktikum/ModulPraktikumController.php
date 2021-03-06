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
        $this->validate($request, [
            'modul' => 'required|file|mimes:pdf|max:2024',
        ],
        [
            'modul.required' => "Modul praktikum wajib diunggah",
            'modul.file' => "Modul praktikum harus berupa file pdf",
            'modul.mimes' => "Modul praktikum harus berupa file pdf",
            'modul.size' => "Modul praktikum maksimal berukuran 2 MB",
        ]);

        $modul_praktikum = ModulPraktikum::where('id_praktikum', $praktikum->id)->first();

        if ($modul_praktikum == NULL) {
            $filename = Upload::uploadFile($request->file('modul'), 'app/modul/');
            $modulname = $filename;
        } else {
            File::delete(storage_path($modul_praktikum->file_modul));
            $filename = Upload::uploadFile($request->file('modul'), 'app/modul/');
            $modulname = $filename;
        }
        
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
