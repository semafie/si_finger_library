<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presensiModel extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'id_siswa',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'keterangan',
        'id_detail',
    ];

    public function siswa()
    {
        return $this->belongsTo(studentModel::class, 'id_siswa');
    }

}
