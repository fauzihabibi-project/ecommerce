<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
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
        'cancellation_reason',
        'cancelled_at',
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


    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public static function findByHashid($hashid)
    {
        $decoded = Hashids::decode($hashid);
        $id = $decoded[0] ?? null;

        return $id ? self::find($id) : null;
    }
}
