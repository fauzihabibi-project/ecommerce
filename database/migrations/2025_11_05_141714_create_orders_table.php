<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // relasi ke users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // relasi ke addresses
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');

            // total & ongkir
            $table->decimal('total_amount', 12, 2);
            $table->decimal('shipping_cost', 12, 2)->default(0);

            // pengiriman
            $table->string('courier')->nullable();          // contoh: JNE, J&T, TIKI
            $table->string('tracking_number')->nullable();  // nomor resi

            // status pesanan
            $table->string('status')->default('Menunggu Pembayaran');
            // 'Menunggu Pembayaran', 'Dikemas', 'Dikirim', 'Selesai'

            // pembatalan
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
