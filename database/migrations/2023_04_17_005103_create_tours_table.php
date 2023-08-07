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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('Users')->constrained()->onUpdate('cascade')->onDelete('cascade');//tour_owner .
            $table->text('name');
            $table->text('source');
            $table->text('destination');
            $table->text('description');
            $table->string('latitude');
            $table->string('longitude');
            $table->date('dateOFTour');
            $table->double('price');
            $table->integer('max_participate');
            $table->boolean('available')->default(true);
            $table->json('images');
            $table->json('path');
            $table->json('ActivityAndTime');
            $table->json('short_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
