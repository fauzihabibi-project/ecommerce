<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method',
        'payment_date',
        'amount',
        'status',
        'proof',
    ];

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    // Relasi ke transaksi
    public function transaction()
    {
        return $this->hasOne(Transactions::class);
    }
}
