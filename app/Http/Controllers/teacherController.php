<?php

namespace App\Http\Controllers;

use App\Models\teacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class teacherController extends Controller
{
    public function tambah(Request $request){

        // dd($request->all());
        $halo = [
            'nip' => 'required',
            'nama_guru' => 'required',
            // 'jenis_kelamin' => 'required',
        ];

        $validasi = Validator::make($request->all(), $halo);

        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->route('admin_guru')->with(Session::flash('kosong_tambah', true));
        }

        $guru = teacherModel::create([
            'nip' => $request->nip,
            'teacher_name' => $request->nama_guru,
            'gender' => $request->jenis_kelamin,
        ]);
        if ($guru) {
            return redirect()->route('admin_guru')->with(Session::flash('berhasil_tambah', true));
        }
    }
    public function edit(Request $request , $id){
        $guru = teacherModel::findorFAil($id);

        $guru->nip = $request->nip;
        $guru->teacher_name = $request->nama_guru;
        $guru->gender = $request->jenis_kelamin;

        $guru->save();

        return redirect()->route('admin_guru')->with(Session::flash('berhasil_edit', true));
    }
    public function hapus(Request $request , $id){
        $guru = teacherModel::findorFAil($id);

        $guru->delete();

        return redirect()->route('admin_guru')->with(Session::flash('berhasil_hapus', true));
    }
}
