<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $guarded = [];
  protected $fillable = [
      'title', 'content', 'published'
  ];
  public function comments(){
    return $this->hasMany('App\Models\Comments', 'on_post');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'author_id');
  }
}
