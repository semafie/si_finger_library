<?php

namespace App\Http\Controllers;

use App\Models\detail_absenModel;
use App\Models\presensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class absensiController extends Controller
{
    public function tambah(Request $request){

        // dd($request->all());
        $halo = [
            'mata_pelajaran' => 'required',
            'id_siswa' => 'required',
        'tanggal' => 'required',
        'jam_masuk' => 'required',
        'keterangan' => 'required',
        ];

        $validasi = Validator::make($request->all(), $halo);

        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->route('admin_matkul')->with(Session::flash('kosong_tambah', true));
        }
        if (!empty($request->id_guru) && !empty($request->id_mapel)) {
            $detail = detail_absenModel::create([
                'id_guru' => $request->id_guru,
                'id_mapel' => $request->id_mapel,
                'keterangan' => $request->keterangan,
            ]);
        } else{
            $absensi = presensiModel::create([
                'id_siswa' => $request->id_siswa,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar,
                'keterangan' => $request->keterangan,
                'id_detail' => $request->id_detail,
            ]);
            if ($absensi) {
                return redirect()->route('admin_matkul')->with(Session::flash('berhasil_tambah', true));
            }
        }
        
        
    }
    public function edit(Request $request , $id){
        $absensi = presensiModel::findorFAil($id);

        $absensi->subject_name = $request->mata_pelajaran;

        $absensi->save();

        return redirect()->route('admin_matkul')->with(Session::flash('berhasil_edit', true));
    }
    public function hapus(Request $request , $id){
        $absensi = presensiModel::findorFAil($id);

        $absensi->delete();

        return redirect()->route('admin_matkul')->with(Session::flash('berhasil_hapus', true));
    }
}
