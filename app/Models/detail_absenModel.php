<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_absenModel extends Model
{
    use HasFactory;

    protected $table = 'learning_details';

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'learning_name',
    ];
    
}
