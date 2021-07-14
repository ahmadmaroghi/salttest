<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balance';
    public $timestamps = true;

    protected $fillable = [
        'mobile',
        'value',
        'id_user'
    ];
}
