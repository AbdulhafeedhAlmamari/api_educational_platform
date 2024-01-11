<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'section_id',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
