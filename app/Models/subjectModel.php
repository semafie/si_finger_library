<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject';

    protected $fillable = [
        'subject_name',
    ];
}
