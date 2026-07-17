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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            // User yang memiliki trip
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Nama destinasi, contoh: Bali, Bandung, Bromo
            $table->string('destination_name');

            // Jenis destinasi
            $table->enum('destination_type', [
                'pantai',
                'gunung',
                'kota'
            ]);

            // Transportasi yang digunakan
            $table->enum('transportation', [
                'pesawat',
                'kereta',
                'mobil',
                'motor',
                'bus',
                'kapal'
            ]);

            // Tempat menginap
            $table->enum('accommodation', [
                'hotel',
                'villa',
                'camping',
                'rumah_saudara'
            ]);

            // Gaya perjalanan
            $table->enum('travel_style', [
                'backpacker',
                'regular',
                'luxury'
            ]);

            // Tanggal perjalanan
            $table->date('departure_date');
            $table->date('return_date');

            // Membawa obat pribadi atau tidak
            $table->boolean('has_medication')->default(false);

            // Catatan tambahan
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};