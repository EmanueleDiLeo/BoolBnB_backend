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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100);
            $table->string('slug', 100);
            $table->tinyInteger('room_number');
            $table->tinyInteger('bed_number');
            $table->tinyInteger('bathroom_number');
            $table->smallInteger('sq_metres')->nullable();
            $table->string('img', 255)->nullable();
            $table->string('img_name', 255)->nullable();
            $table->string('address', 255);
            $table->decimal('lon', $precision = 11, $scale = 8);
            $table->decimal('lat', $precision = 11, $scale = 8);
            $table->tinyInteger('visible')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');

    }
};
