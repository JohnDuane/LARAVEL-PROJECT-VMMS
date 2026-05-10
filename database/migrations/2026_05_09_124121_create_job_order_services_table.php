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
        Schema::create('job_order_services', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('job_order_id');
            $table->unsignedBigInteger('service_id');

            $table->timestamps();

            $table->foreign('job_order_id')
                ->references('job_order_id')
                ->on('job_order')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('service_id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_services');
    }
};
