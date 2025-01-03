<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'reply']);
    
            $table->unsignedBigInteger('sender_id')->after('id');
            $table->unsignedBigInteger('receiver_id')->after('sender_id');
            $table->text('message')->change();
            $table->boolean('is_read')->default(false)->after('message');
    
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
            $table->dropColumn(['sender_id', 'receiver_id', 'is_read']);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('reply')->nullable();
        });
    }
};
