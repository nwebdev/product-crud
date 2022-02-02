<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'upc',
        'status',
        'image'
    ];

    public function getImageUrlAttribute()
    {
        return asset($this->attributes['image']);
    }
}
