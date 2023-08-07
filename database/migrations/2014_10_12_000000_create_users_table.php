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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->text('city');
            // $table->string('coords_lat');
            // $table->string('coords_lng');
            $table->string('phone_number');
            $table->string('image')->default('user_img/defult.png');
            $table->enum('type', ['admin' , 'tour_owner' , 'user'])->default('user');
            $table->enum('setting', ['public' , 'private'])->default('private');
            $table->rememberToken();
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
