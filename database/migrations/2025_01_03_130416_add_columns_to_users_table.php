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
        Schema::table('users', function (Blueprint $table) {
            // Sütunları yeniden adlandır
            $table->renameColumn('profile_image', 'avatar'); // profile_image -> avatar
            $table->renameColumn('email_verified_at', 'last_login'); // email_verified_at -> last_login

            // Gereksiz sütunları kaldır
            $table->dropColumn('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Geri alma işlemi: eski sütunları yeniden adlandır
            $table->renameColumn('avatar', 'profile_image');
            $table->renameColumn('last_login', 'email_verified_at');

            // Eski sütunları geri ekle
            $table->string('remember_token', 100)->nullable();
        });
    }
};
