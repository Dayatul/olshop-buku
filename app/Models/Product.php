<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'photo',
        'price',
        'about',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
