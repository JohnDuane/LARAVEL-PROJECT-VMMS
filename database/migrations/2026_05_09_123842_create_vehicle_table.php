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
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id('vehicle_id');

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customer')
                ->onDelete('cascade');

            $table->string('plate_number', 50)->nullable();
            $table->string('make', 100)->nullable();
            $table->string('engine_model', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle');
    }
};
