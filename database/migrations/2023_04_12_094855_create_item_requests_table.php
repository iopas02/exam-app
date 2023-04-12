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
        Schema::create('item_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itemId');
            $table->unsignedBigInteger('clientId');
            $table->unsignedBigInteger('adminId')->nullable();
            $table->integer('quantity');
            $table->string('status');
            $table->timestamps();

            $table
            ->foreign('itemId')
            ->references('id')
            ->on('items')
            ->onDelete('cascade');

            $table
            ->foreign('clientId')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table
            ->foreign('adminId')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_requests');
    }
};
