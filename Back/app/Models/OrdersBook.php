<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersBook extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'order_id', 'count'];

}
