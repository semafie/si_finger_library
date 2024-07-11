<?php

namespace App\Http\Controllers;

use App\Models\studentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function tambah(Request $request){

        // dd($request->all());
        $halo = [
            'nisn' => 'required',
            'nama_siswa' => 'required',
            'kelas' => 'required',
            // 'jenis_kelamin' => 'required',
        ];

        $validasi = Validator::make($request->all(), $halo);

        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->route('admin_siswa')->with(Session::flash('kosong_tambah', true));
        }

        $siswa = studentModel::create([
            'nisn' => $request->nisn,
            'student_name' => $request->nama_siswa,
            'class' => $request->kelas,
            'gender' => $request->jenis_kelamin,
        ]);
        if ($siswa) {
            return redirect()->route('admin_siswa')->with(Session::flash('berhasil_tambah', true));
        }
    }
    public function edit(Request $request , $id){
        $siswa = studentModel::findorFAil($id);

        $siswa->nisn = $request->nisn;
        $siswa->student_name = $request->nama_siswa;
        $siswa->class = $request->kelas;
        $siswa->gender = $request->jenis_kelamin;

        $siswa->save();

        return redirect()->route('admin_siswa')->with(Session::flash('berhasil_edit', true));
    }
    public function hapus(Request $request , $id){
        $siswa = studentModel::findorFAil($id);

        $siswa->delete();

        return redirect()->route('admin_siswa')->with(Session::flash('berhasil_hapus', true));
    }
}
