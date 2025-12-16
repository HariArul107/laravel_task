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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sales_id');
            $table->unsignedBigInteger('purchase_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();


            $table->foreign('purchase_id')->references('purchase_id')
                ->on('purchase')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')
                ->on('projectusers')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
