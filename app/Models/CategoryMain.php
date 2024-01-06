<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMain extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];

    public function categorySubs()
    {
        return $this->hasMany(CategorySub::class, 'category_main_id');
    }
}
