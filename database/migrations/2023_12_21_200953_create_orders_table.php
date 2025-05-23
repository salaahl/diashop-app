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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('command_number');
            $table->string('fullname');
            $table->string('email');
            $table->json('products');
            $table->json('billing_address');
            $table->json('shipping_address');
            $table->json('amount');
            $table->integer('user_id')->nullable();
            $table->string('track_number')->nullable();
            $table->string('stripe_transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
