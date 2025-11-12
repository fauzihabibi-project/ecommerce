<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category_id',
        'stock',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

}
