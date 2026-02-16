<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_orders', function (Blueprint $table) {
        $table->id();
        $table->string('name')->default('Cash order');         // Customer name (optional)
        $table->json('items');                      // JSON of items
        $table->decimal('total', 10, 2);            // Total amount
        $table->string('payment_status')->default('cash');
        $table->timestamps();                       // created_at, updated_at
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_orders');
    }
}
