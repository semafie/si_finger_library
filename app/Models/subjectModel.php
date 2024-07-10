<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectModel extends Model
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
