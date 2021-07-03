<?php

namespace App\Http\Controllers\AdditionalData;

use App\Model\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allLecture()
    {
        $lecture = Dosen::get();
        return view('additional-data.lecture.all-lecture', compact('lecture'));
    }

    public function addLecture()
    {
        return view('additional-data.lecture.add-lecture');
    }

    public function storeLecture(Request $request)
    {
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
            'email' => "required|email|unique:tb_dosen,email",
            'nomor_telepon' => "required|unique:tb_dosen,nomor_telepon|numeric|digits_between:12,15",
            'username_telegram' => "nullable|unique:tb_dosen,username_telegram|max:27",
        ],
        [
            'nama.required' => "Nama lengkap wajib diisi",
            'nama.regex' => "Format nama tidak sesuai",
            'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email valid",
            'email.unique' => "Email tidak dapat digunakan",
            'nomor_telepon.required' => "Nomor telepon wajib diisi",
            'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
            'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
            'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username_telegram.unique' => "Username telegram tidak dapat digunakan",
            'username_telegram.max' => "Username telegram maksimal berjumlah 27 karakter",
        ]);

        try {
            DB::beginTransaction();
                Dosen::create([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'nomor_telepon' => $request->nomor_telepon,
                    'username_telegram' => $request->username_telegram,
                    'status' => 'Aktif',
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Data dosen berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Data dosen gagal ditambahkan');
        }
    }

    public function updateStatusLecture(Request $request, $id)
    {
        try {
            DB::beginTransaction();
               Dosen::where('id', $id)->update([
                    'status' => $request->status
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Status dosen berhasil diperbaharui');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Status dosen gagal diperbaharui');
        }
    }

    public function editLecture(Dosen $dosen)
    {
        return view('additional-data.lecture.edit-lecture', compact('dosen'));
    }

    public function updateLecture(Request $request, Dosen $dosen)
    {
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|max:100",
            'username_telegram' => "nullable|unique:tb_dosen,username_telegram|max:27",
        ],
        [
            'nama.required' => "Nama lengkap wajib diisi",
            'nama.regex' => "Forma nama tidak sesuai",
            'nama.max' => "Nama lengkap maksimal berjumlah 100 karakter",
            'username_telegram.unique' => "Username telegram tidak dapat digunakan",
            'username_telegram.max' => "Username telegram maksimal berjumlah 27 karakter",
        ]);

        if ($dosen->email != $request->email) {
            $this->validate($request,[
                'email' => "required|email|unique:tb_dosen,email",
            ],
            [
                'email.required' => "Email wajib diisi",
                'email.email' => "Masukan email valid",
                'email.unique' => "Email tidak dapat digunakan",
            ]);
        } elseif ($dosen->email == $request->email) {
            $this->validate($request,[
                'email' => "required|email",
            ],
            [
                'email.required' => "Email wajib diisi",
                'email.email' => "Masukan email valid",
            ]);
        }

        if ($dosen->nomor_telepon != $request->nomor_telepon) {
            $this->validate($request,[
                'nomor_telepon' => "required|unique:tb_dosen,nomor_telepon|numeric|digits_between:12,15",
            ],
            [
                'nomor_telepon.required' => "Nomor telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
                'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            ]);
        } elseif ($dosen->nomor_telepon == $request->nomor_telepon) {
            $this->validate($request,[
                'nomor_telepon' => "required|numeric|digits_between:12,15",
            ],
            [
                'nomor_telepon.required' => "Nomor telepon tidak dapat digunakan",
                'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            ]);
        }

        try {
            DB::beginTransaction();
                Dosen::where('id', $dosen->id)->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'nomor_telepon' => $request->nomor_telepon,
                    'username_telegram' => $request->username_telegram,
                ]);
            DB::commit();
            
            return redirect()->back()->with('success', 'Data dosen berhasil diperbaharui');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Data dosen gagal diperbaharui');
        }
    }
}