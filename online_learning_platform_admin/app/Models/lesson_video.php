<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson_video extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'lesson_id',
        'file_name'
    ];
}
