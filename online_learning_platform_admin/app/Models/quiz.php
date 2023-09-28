<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;
    protected $fillable =[
        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'answer',
        'lesson_id',
    ];
}
