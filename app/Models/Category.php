<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'icon',
        'name',
        'slug',
        'file_types',
        'show_at_nav',
        'show_at_featured'
    ];

    protected function casts(): array
    {
        return [
            'file_types' => 'array',
        ];
    }
}
