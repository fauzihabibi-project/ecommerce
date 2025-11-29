<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'order_id',
        'transaction_code',
        'transaction_date',
        'total_amount',
        'status',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke payment
    public function payment()
    {
        return $this->belongsTo(Payments::class, 'payment_id');
    }

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
