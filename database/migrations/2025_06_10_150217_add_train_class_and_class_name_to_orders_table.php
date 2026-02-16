<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrainClassAndClassNameToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->string('train_class')->after('seat');  // e.g., '1', '2', '3'
        $table->string('class_name')->after('train_class');  // e.g., 'A', 'B', 'C', 'D'
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['train_class', 'class_name']);
    });
    }
}
