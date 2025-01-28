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
        Schema::create('tm_pengembalians', function (Blueprint $table) {
            $table->string('kembali_id', 20)->primary();
            $table->string('pb_id', 20);
            $table->foreign('pb_id')->references('pb_id')->on('tm_peminjamans');
            $table->string('user_id', 10);
            $table->foreign('user_id')->references('user_id')->on('tm_users');
            $table->dateTime('kembali_tgl');
            $table->char('kembali_sts', 2);
            $table->timestamps();
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
