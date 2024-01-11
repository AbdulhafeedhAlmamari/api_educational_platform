<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teacher_id',
        'category_id',
        'description',
        'start_date',
        'end_date',
        'price',
        'discount',
        'url_image',
        'status',
    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recorders()  // enrollments
    {
        return $this->hasMany(Recorder::class);
    }
    public function favorites()  // enrollments
    {
        return $this->hasMany(Recorder::class);
    }
    public function lessones()
    {
        return $this->hasMany(Lessone::class);
    }

    public function ratingsCourse()
    {
        return $this->hasMany(RatingsCourse::class);
    }
}
