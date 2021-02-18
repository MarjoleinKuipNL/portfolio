<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $fillable = ['title', 'body', 'image', 'category', 'slug'];

    public function searchableAs(){
        return 'posts_index';
    }
    public function toSearchableArray(){
        return [
            'title',
            'body',
            'category',
            'slug'];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
