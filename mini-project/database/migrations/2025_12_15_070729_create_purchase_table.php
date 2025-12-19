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
        Schema::create('purchase', function (Blueprint $table) {

            $table->id('purchase_id'); // primary key
            $table->string('supplier_name');
            $table->date('purchase_date');
            $table->string('address');
            $table->unsignedBigInteger('item_id'); // foreign key to items
            $table->unsignedBigInteger('user_id'); // user who purchased
             $table->integer('total_quantity');
            $table->integer('quantity')->default(1); // quantity purchased
            $table->decimal('total_price', 10, 2); // total price for the purchase
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('item_id')->references('item_id')
                ->on('items')->onDelete('cascade')
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
        Schema::dropIfExists('purchase');
    }
};
