<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    public $timestamps = true;

    protected $fillable = [
        'order_no',
        'total_balance',
        'total_product'
    ];
}
