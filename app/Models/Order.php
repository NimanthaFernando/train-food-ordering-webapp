<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Order extends Model
{
    public function up()    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ticket');
            $table->string('phone');
            $table->string('seat');
            $table->string('class');
            $table->json('items'); // to store cart items
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->string('order_status')->default('Pending');
            $table->text('feedback')->nullable();
        });    }
    protected $fillable = [
        'user_id',
        'ticket',
        'total',
        'payment_status',
        'order_status',
        'items',
        'train_class',
        'class_name',
        'email',
        'phone',
        'seat',
        'feedback'
    ];

}
