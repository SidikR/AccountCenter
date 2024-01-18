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
        Schema::create('user_applications', function (Blueprint $table) {
            $table->id('id_auth_application');
            $table->string('email', 50);
            $table->foreignId('id_applications');
            $table->enum('role_user', ['user', 'admin', 'verifikator', 'super_admin', 'bupati', 'kadis', 'sekdis', 'kabid', 'kasi', 'staff']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_application');
    }
};
