<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt',
        'meta_title', 'meta_description', 'image', 'video', 'video_url',
        'status', 'published_at', 'visited',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'visited' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }
}
