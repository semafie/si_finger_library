<?php

namespace App\Http\Controllers;

use App\Models\detail_absenModel;
use App\Models\presensiModel;
use App\Models\studentModel;
use App\Models\subjectModel;
use App\Models\teacherModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{

    public function __construct()
        {


        $adminEmail = 'admin@gmail.com';
    
 
        $adminUser = User::where('email', $adminEmail)->first();
        
        

        if (!$adminUser) {
            User::create([

                'username' => 'admin',
                'role' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
            ]);
        }

    }
    public function show_login(){
        return view('login');
    }
    public function show_home(){
        return view('user.home');
    }
    public function show_pilih(){
        return view('user.pilih_keterangan');
    }
    public function show_guru(){
        return view('user.input_guru');
    }

    public function kembalimemilih(Request $request){
        $siswa = studentModel::where('nisn', $request->nisn)->first();
        if ($siswa) {
            // Lakukan sesuatu dengan data siswa
            return view('user.pilih_keterangan',[
                'siswa' => $siswa,
            ]);
        }
    }
    public function cari(Request $request){
        $absen = presensiModel::with('siswa') // Memuat relasi 'siswa'
                 ->whereHas('siswa', function ($query) use ($request) {
                     $query->where('nisn', $request->nisn); // Kondisi berdasarkan nisn pada relasi 'siswa'
                 })
                 ->whereDate('tanggal', now()->toDateString()) // Kondisi tanggal saat ini
                 ->whereNull('jam_keluar') // Kondisi jam_keluar tidak kosong
                 ->first();

        $siswa = studentModel::where('nisn', $request->nisn)->first();

  if($absen){
            $absen->jam_keluar = now()->toTimeString();

            $absen->save();
            return redirect()->route('user_home')->with(Session::flash('berhasil_keluar', true));
        } elseif ($siswa) {
            // Lakukan sesuatu dengan data siswa
            return view('user.pilih_keterangan',[
                'siswa' => $siswa,
            ]);
        } else {
            // Jika siswa tidak ditemukan
            return redirect()->route('user_home')->with(Session::flash('tidak_ditemukan', true));;
        }
        
        
    }

    public function tambah_membaca(Request $request,$id){
        $absen = presensiModel::where('id_siswa' , $id)->whereDate('tanggal' , now()->toDateString())->first();
        if(!$absen) {
        $presensi = presensiModel::create([
            'id_siswa' => $id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'keterangan' => "membaca buku",
        ]);
        
        if ($presensi) {
            return redirect()->route('user_home')->with(Session::flash('membaca_buku', true));
        }
        } else{
            return redirect()->route('user_home')->with(Session::flash('sudah_absen', true));
        }
    }
    public function tambah_meminjam(Request $request,$id){
        $absen = presensiModel::where('id_siswa' , $id)->whereDate('tanggal' , now()->toDateString())->first();
        if(!$absen) {
        $presensi = presensiModel::create([
            'id_siswa' => $id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'keterangan' => "meminjam buku",
        ]);
        
        if ($presensi) {
            return redirect()->route('user_home')->with(Session::flash('pinjam_buku', true));
        }
    } else{
        return redirect()->route('user_home')->with(Session::flash('sudah_absen', true));
    }
    }
    public function tambah_mengembalikan(Request $request,$id){

        $absen = presensiModel::where('id_siswa' , $id)->whereDate('tanggal' , now()->toDateString())->first();
        if(!$absen) {
            $presensi = presensiModel::create([
                'id_siswa' => $id,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => now()->toTimeString(),
                'keterangan' => "mengembalikan buku",
            ]);
            
            if ($presensi) {
                return redirect()->route('user_home')->with(Session::flash('kembalikan_buku', true));
            }
        } else{
            return redirect()->route('user_home')->with(Session::flash('sudah_absen', true));
        }

        
    }
    public function tambah_pembelajaran(Request $request){

        // dd($request->all());

        
        $absen2 = presensiModel::where('id_siswa' , $request->id_siswa)->whereDate('tanggal' , now()->toDateString())->first();
        if(!$absen2) {
            
                $detail_absen = detail_absenModel::create([
                    'id_guru' => $request->id_guru,
                    'id_mapel' => $request->id_mapel,
                    'learning_name' =>  $request->keterangan,
                ]);
                if($detail_absen){
                    $detail_absens = detail_absenModel::latest()->first();
                    $presensi = presensiModel::create([
                        'id_siswa' => $request->id_siswa,
                        'tanggal' => now()->toDateString(),
                        'jam_masuk' => now()->toTimeString(),
                        'keterangan' => "pembelajaran",
                        'id_detail' => $detail_absens->id,
                    ]);
                    
                    if ($presensi) {
                        return redirect()->route('user_home')->with(Session::flash('berhasil_tambah', true));
                    }
                }
            
            
            
        }else {
            
            return redirect()->route('user_home')->with(Session::flash('sudah_absen', true));
        }

        
    }

    public function setbelajar(Request $request){
        $absen = presensiModel::where('id_siswa' , $request->id)->whereDate('tanggal' , now()->toDateString())->first();
        if(!$absen) {
        $siswa = studentModel::where('nisn', $request->nisn)->first();
        $guru = teacherModel::all();
        $mapel = subjectModel::all();
        if ($siswa) {
            // Lakukan sesuatu dengan data siswa
            return view('user.input_guru',[
                'siswa' => $siswa,
                'guru'=> $guru,
                'mapel'=> $mapel,
            ]);
        } 
    } else {
        return redirect()->route('user_home')->with(Session::flash('sudah_absen', true));
    }
    }
}
