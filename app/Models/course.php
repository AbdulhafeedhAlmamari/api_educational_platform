<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teacher_id',
        'category_sub_id',
        'description',
        'start_date',
        'end_date',
        'price',
        'discount',
        'url_image',
        'status',
    ];
}
