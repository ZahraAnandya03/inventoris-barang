<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tm_pengembalian', function (Blueprint $table) {
        $table->string('kembali_id', 20)->primary();
        $table->string('pb_id', 20); // Pastikan tipe data sama dengan di tm_peminjaman
        $table->string('user_id', 10)->nullable();
        $table->dateTime('kembali_tgl')->nullable();
        $table->char('kembali_sts', 2)->nullable();
        $table->timestamps();

        // Menambahkan foreign key
        $table->foreign('pb_id')
              ->references('pb_id')  // Kolom yang direferensikan di tabel tm_peminjaman
              ->on('tm_peminjaman')  // Tabel yang direferensikan
              ->onDelete('cascade');  // Jika data di tm_peminjaman dihapus, data yang terkait di tm_pengembalian juga dihapus
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_pengembalians');
    }
};
