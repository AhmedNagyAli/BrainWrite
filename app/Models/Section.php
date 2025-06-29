<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'post_id', 'title', 'content', 'image', 'link',
        'order', 'video', 'video_url',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    protected static function booted()
{
    static::creating(function ($section) {
        if (is_null($section->order)) {
            $max = $section->post->sections()->max('order') ?? 0;
            $section->order = $max + 1;
        }
    });
}
}
