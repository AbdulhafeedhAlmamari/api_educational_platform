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
}
