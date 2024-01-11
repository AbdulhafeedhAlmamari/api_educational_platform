<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone_number',
        'address',
        'password',
        'url_image',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function recorders()  // enrollments
    {
        return $this->hasMany(Recorder::class);
    }
    public function favorites()  // enrollments
    {
        return $this->hasMany(Recorder::class);
    }

    public function ratingsCourse()
    {
        return $this->hasMany(RatingsCourse::class);
    }
}
