<?php

namespace App\Http\Controllers;

use App\Models\presensiModel;
use App\Models\studentModel;
use App\Models\subjectModel;
use App\Models\teacherModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function show_dashboard(){
        
        return view('admin.layout.dashboard',[
            'title' => 'Dashboard',
            'getRecord' => User::find(Auth::user()->id),
        ]);
    }

    public function show_guru(){
        $guru = teacherModel::all();
        return view('admin.layout.data_guru',[
            'title' => 'Data Guru',
            'guru' => $guru,
            'getRecord' => User::find(Auth::user()->id),
        ]);
    }
    public function show_siswa(){
        $siswa = studentModel::all();
        return view('admin.layout.siswa',[
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'getRecord' => User::find(Auth::user()->id),
        ]);
    }
    public function show_matkul(){
        $matkul = subjectModel::all();
        return view('admin.layout.mata_pelajaran',[
            'title' => 'Data Mata Pelajaran',
            'matkul' => $matkul,
            'getRecord' => User::find(Auth::user()->id),
        ]);
    }
    public function show_absensi(){
        $matkul = subjectModel::all();
        $absensi = presensiModel::with('siswa')->get();
        return view('admin.layout.Absensi',[
            'title' => 'Data Absensi',
            'matkul' => $matkul,
            'getRecord' => User::find(Auth::user()->id),
            'absensi' => $absensi,
        ]);
    }
}
