<?php

namespace App\Http\Controllers;

use App\Models\subjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function tambah(Request $request){

        // dd($request->all());
        $halo = [
            'mata_pelajaran' => 'required',
            // 'jenis_kelamin' => 'required',
        ];

        $validasi = Validator::make($request->all(), $halo);

        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->route('admin_matkul')->with(Session::flash('kosong_tambah', true));
        }

        $siswa = subjectModel::create([
            'subject_name' => $request->mata_pelajaran,
        ]);
        if ($siswa) {
            return redirect()->route('admin_matkul')->with(Session::flash('berhasil_tambah', true));
        }
    }
    public function edit(Request $request , $id){
        $siswa = subjectModel::findorFAil($id);

        $siswa->subject_name = $request->mata_pelajaran;

        $siswa->save();

        return redirect()->route('admin_matkul')->with(Session::flash('berhasil_edit', true));
    }
    public function hapus(Request $request , $id){
        $siswa = subjectModel::findorFAil($id);

        $siswa->delete();

        return redirect()->route('admin_matkul')->with(Session::flash('berhasil_hapus', true));
    }


    
}
