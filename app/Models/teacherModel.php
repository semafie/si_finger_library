<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacherModel extends Model
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = [
        'teacher_name',
        'class',
        'gender',
        'nip',
    ];
}
