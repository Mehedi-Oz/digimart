<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorWithdrawInformation extends Model
{
    protected $fillable = [
        'author_id',
        'withdraw_method_id',
        'information',
    ];
}
