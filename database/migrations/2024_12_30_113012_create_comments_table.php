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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kullanıcının ismi
            $table->string('email'); // Kullanıcının e-posta adresi
            $table->text('comment'); // Yorum metni
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending'); // Yorum durumu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
