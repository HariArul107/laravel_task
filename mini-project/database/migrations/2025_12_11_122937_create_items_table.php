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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('item_name', 50);
            $table->string('category_name');
            $table->unsignedBigInteger('prize');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('projectusers')            // users table
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')            // users table
                ->onDelete('cascade')
                ->onUpdate('cascade');

                
            $table->unique(['category_name', 'item_name', 'user_id'], 'item_category_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
