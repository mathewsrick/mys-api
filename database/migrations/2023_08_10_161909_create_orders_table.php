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
            $table->enum('status', ['IN_PROGRESS', 'PROCESSED', 'CANCELED'])->default('IN_PROGRESS');
            $table->date('delivery_date')->nullable();
            $table->enum('delivered', ['DELIVERED', 'ON_WAY', 'NOT_DELIVERED'])->default('ON_WAY');
            $table->enum('payment', ['PENDING', 'PAID', 'NOT_PAID'])->default('PENDING');
            $table->enum('payment_method', ['ON_DELIVERY', 'ONLINE'])->default('ON_DELIVERY');
            $table->enum('payment_type', ['CASH', 'TRANSFER', 'NEQUI'])->default('TRANSFER');
            $table->float('amount');
            
            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('address');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->float('discount');

            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

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
