<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FieldStory extends Model
{
    protected $fillable = [
        'title', 'title_en', 'title_ja', 'slug', 'excerpt', 'excerpt_en', 'excerpt_ja', 'content', 'content_en', 'content_ja',
        'image_path', 'is_published', 'published_at', 'views',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (FieldStory $story) {
            if (empty($story->slug)) {
                $story->slug = Str::slug($story->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
