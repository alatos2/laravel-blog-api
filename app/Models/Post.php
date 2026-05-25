<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug',
        'body', 'cover_image', 'status', 'published_at'
    ];

    protected $cast = [
        'published_at' => 'datetime'
    ];

    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug');
    }

    // relationships

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // only approved top level comment
    public function approvedComments() {
        return $this->hasMany(Comment::class)
                    ->where('approved', true)
                    ->whereNull('parent_id');
    }

}
