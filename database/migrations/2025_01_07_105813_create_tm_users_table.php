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
        // Tabel user/pengguna
        Schema::create('tm_user', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 10)->primary();
            $table->string('user_nama', 50)->nullabel();
            $table->string('user_pass', 32)->nullabel();
            $table->char('user_hak', 2)->nullabel();
            $table->char('user_sts', 2)->nullabel();
        });              
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_users');
    }
};
