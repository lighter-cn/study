<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
