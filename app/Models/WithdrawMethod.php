<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $fillable = [
        'name',
        'minimum_amount',
        'maximum_amount',
        'description',
        'status',
    ];
}
