<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('discount')->default(0);
            $table->enum('status', ['pending', 'processing', 'cancelled', 'shipped', 'delivered']);
            $table->enum('payment_status', ['paid', 'not_paid']);
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('address_id')->constrained('order_addresses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
