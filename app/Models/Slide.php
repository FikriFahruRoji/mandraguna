<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'subtitle',
        'subtitle_en',
        'image_path',
        'cta_text',
        'cta_text_en',
        'cta_link',
        'sort_order'
    ];
}
