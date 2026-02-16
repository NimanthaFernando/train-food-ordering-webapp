<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'users'; // use your actual table name

    protected $fillable = ['name', 'email', 'phone']; // update based on your table columns

    public $timestamps = false; // only if your table doesn't have `created_at`, `updated_at`
}