<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'user_id', 'parent_id', 'body', 'approved'
    ];

    protected $cast = [
        'approved' => 'boolean'
    ];

    //relationships
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Nested replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
