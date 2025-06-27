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
}
