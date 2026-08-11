<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\Attributes\Sluggable;

#[Sluggable(from: 'name', to: 'slug')]
class Item extends Model
{
    protected $fillable = [
        'author_id',
        'name',
        'slug',
        'description',
        'category_id',
        'sub_category_id',
        'options',
        'version',
        'demo_link',
        'tags',
        'thumbnail',
        'preview_type',
        'preview_image',
        'preview_video',
        'preview_audio',
        'main_file',
        'is_main_file_external',
        'screenshots',
        'price',
        'discount_price',
        'is_supported',
        'support_instruction',
        'status',
        'total_sales',
        'total_sale_amount',
        'total_earnings',
        'is_free',
        'is_trending',
        'is_best-selling',
        'is_on_discount',
        'is_featured',
    ];

    protected $casts = [
        'options' => 'array',
        'tags' => 'array',
        'screenshots' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
