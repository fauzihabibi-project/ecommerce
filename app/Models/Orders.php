<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'total_amount',
        'shipping_cost',
        'courier',
        'tracking_number',
        'status',
        'payment_proof',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke alamat
    public function address()
    {
        return $this->belongsTo(Addresses::class, 'address_id');
    }

    // Relasi ke item order
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    // Relasi ke pembayaran
    public function payment()
    {
        return $this->hasOne(Payments::class, 'order_id');
    }

    // Relasi ke transaksi
    public function transaction()
    {
        return $this->hasOne(Transactions::class);
    }
}
