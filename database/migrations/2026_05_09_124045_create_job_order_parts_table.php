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
        Schema::create('job_order_parts', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('job_order_id')->nullable();
            $table->unsignedBigInteger('part_id')->nullable();

            $table->integer('quantity')->nullable();
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('job_order_id')
                ->references('job_order_id')
                ->on('job_order')
                ->onDelete('cascade');

            $table->foreign('part_id')
                ->references('part_id')
                ->on('part');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_parts');
    }
};
