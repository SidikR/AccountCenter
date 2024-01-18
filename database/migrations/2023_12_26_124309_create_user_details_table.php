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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id('id_user_details');
            $table->string('email', 50)->unique();
            $table->string('nama_lengkap', 50)->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('no_hp', 16)->nullable();
            $table->string('foto_user')->nullable();
            $table->string('id_opds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
