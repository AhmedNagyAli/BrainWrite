<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt',
        'meta_title', 'meta_description', 'image', 'video', 'video_url',
        'status', 'published_at', 'visited','featured','featured_until',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'visited' => 'integer',
        'featured' => 'boolean',
        'featured_until' => 'datetime',
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
    public function savedByUsers()
{
    return $this->belongsToMany(User::class, 'post_user_saves')->withTimestamps();
}


    // Scope for featured posts
    public function scopeFeatured($query)
    {
        return $query->where('featured', true)
                 ->where(function($q) {
                     $q->whereNull('featured_until')
                       ->orWhere('featured_until', '>', now());
                 });
    }
}
