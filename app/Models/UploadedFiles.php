<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedFiles extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
        'name',
        'mime_type',
        'extension',
        'size',
        'path',
    ];
}
