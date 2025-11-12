<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
