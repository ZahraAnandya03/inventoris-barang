<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up()
    {
        Schema::create('tm_peminjaman', function (Blueprint $table) {
            $table->string('pb_id', 20)->primary(); 
            $table->string('user_id', 10)->nullable();
            $table->dateTime('pb_tgl')->nullable();
            $table->string('pb_no_siswa', 20)->nullable();
            $table->string('pb_nama_siswa', 100)->nullable();
            $table->dateTime('pb_harus_kembali_tgl')->nullable();
            $table->char('pb_stat', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_peminjaman');
    }
};
