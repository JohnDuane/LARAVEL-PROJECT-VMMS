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
        Schema::create('stockin', function (Blueprint $table) {

            $table->id('stock_in_id');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('part_id')->nullable();

            $table->date('stock_in_arrived')->nullable();
            $table->integer('quantity_received')->nullable();
            $table->decimal('cost_per_unit', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('supplier');

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
        Schema::dropIfExists('stockin');
    }
};
