<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    // protected $guard = 'student';
}
