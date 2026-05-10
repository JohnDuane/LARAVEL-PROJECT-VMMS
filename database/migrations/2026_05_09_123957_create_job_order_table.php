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
        Schema::create('job_order', function (Blueprint $table) {

            $table->id('job_order_id');

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customer');

            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();

            $table->date('date_issued')->nullable();
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->string('status', 50)->nullable();

            $table->timestamps();

            $table->foreign('vehicle_id')
                ->references('vehicle_id')
                ->on('vehicle')
                ->onDelete('cascade');

            $table->foreign('staff_id')
                ->references('staff_id')
                ->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order');
    }
};
