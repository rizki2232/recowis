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
        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('category_id')
                  ->constrained()
                  ->restrictOnDelete();

            $table->text('description');
            $table->string('image');
            $table->string('open_time');
            $table->string('close_time');

            $table->integer('ticket_price');

            $table->text('address');
            $table->string('location');

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_spots');
    }
};
