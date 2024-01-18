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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('email', 50)->unique();
            $table->string('password');
            // $table->enum('role', ['user', 'admin', 'verifikator', 'super_admin', 'bupati', 'kadis', 'sekdis', 'kabid', 'kasi', 'staff']);
            $table->enum('status_akun', ['aktif', 'belum', 'proses', 'mati']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
