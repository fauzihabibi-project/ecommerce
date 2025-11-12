<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    // Nama tabel (opsional, karena Eloquent sudah otomatis paham)
    protected $table = 'addresses';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'user_id',
        'recipient_name',
        'recipient_phone',
        'province_id',
        'city_id',
        'address_detail',
        'postal_code',
        'notes',
        'is_default',
    ];

    // 🧭 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\Cities.php
    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province_id', 'id');
    }


    // App\Models\Provinces.php
    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }



    // 🟢 Helper untuk menampilkan status alamat utama
    public function getIsDefaultLabelAttribute()
    {
        return $this->is_default ? 'Alamat Utama' : 'Alamat Tambahan';
    }
}
