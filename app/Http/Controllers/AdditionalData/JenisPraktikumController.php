<?php

namespace App\Http\Controllers\AdditionalData;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\JenisPraktikum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JenisPraktikumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jenisPraktikum()
    {
        $jenis_praktikum = JenisPraktikum::get();
        return view('additional-data.jenis-praktikum.jenis-praktikum', compact('jenis_praktikum'));
    }

    public function storeJenisPraktikum(Request $request)
    {
        $this->validate($request,[
            'nama_praktikum' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
            'semester' => "required",
            'konsentrasi' => "required",
        ],
        [
            'nama_praktikum.required' => "Nama jenis praktikum wajib diisi",
            'nama_praktikum.regex' => "Format nama jenis praktikum tidak sesuai",
            'nama_praktikum.max' => "Nama jenis praktikum maksimal berjumlah 100 karakter",
            'semester.required' => "Semester wajib dipilih",
            'konsentrasi.required' => "Konsentrasi wajib dipilih",
        ]);

        try {
            DB::beginTransaction();
                JenisPraktikum::create([
                    'nama_praktikum' => $request->nama_praktikum,
                    'semester' => $request->semester,
                    'konsentrasi' => $request->konsentrasi,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Jenis praktikum berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Jenis praktikum gagal ditambahkan');
        }
    }

    public function deleteJenisPraktikum($id)
    {
        $now = Carbon::now()->setTimezone('GMT+8')->format('Y-m-d h:i:s');

        try {
            DB::beginTransaction();
                JenisPraktikum::where('id', $id)->update([
                    'deleted_at' => $now,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Jenis praktikum berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Jenis praktikum gagal dihapus');
        }
    }
}
