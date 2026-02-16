<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'ticket')) {
                $table->string('ticket')->nullable();
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('orders', 'seat')) {
                $table->string('seat')->nullable();
            }
            if (!Schema::hasColumn('orders', 'class')) {
                $table->string('class')->nullable();
            }
            if (!Schema::hasColumn('orders', 'items')) {
                $table->text('items')->nullable();
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 8, 2)->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'ticket', 'phone', 'seat', 'class', 'items', 'total']);
        });
    }
};
