<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Comment extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'from_user');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'on_post');
    }
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
