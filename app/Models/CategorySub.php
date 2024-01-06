<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_main_id',
        'status'
    ];

    public function categoryMain()
    {
        return $this->belongsTo(CategoryMain::class, 'category_main_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
