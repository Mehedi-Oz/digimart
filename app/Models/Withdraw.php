<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'author_id',
        'amount',
        'method',
        'account',
        'status',
    ];
}
