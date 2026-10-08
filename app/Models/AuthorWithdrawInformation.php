<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorWithdrawInformation extends Model
{
    protected $fillable = [
        'author_id',
        'withdraw_method_id',
        'information',
    ];

    public function withdrawGateway(): BelongsTo
    {
        return $this->belongsTo(WithdrawMethod::class, 'withdraw_method_id', 'id');
    }
}
