<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;



class student extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $primaryKey = 'student_id';
    protected $fillable =[
        'student_id',
        'name',
        'email',
        'password',
        'reset_password_token',
        'reset_password_sent_at'
    ];
    protected $hidden = [
        'password',

    ];
}
