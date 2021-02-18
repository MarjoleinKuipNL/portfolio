<?php

namespace App\Models;

use App\Models\SocialAccount;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function accounts(){
        return $this->hasMany('App\Models\SocialAccount');
    }
    public function posts(){
        return $this->hasMany(Post::class, 'author_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'from_user');
    }
    public function searchableAs()
    {
        return 'users_index';
    }
    public function can_post(){
        $role = $this->role;
        if($role == 'author'|| role == 'admin'){
            return true;
        }
        return false;
    }
    public function is_admin(){
        $role = $this->role;
        if($role == 'admin'){
            return true;
        }else {
            return false;
        }
    }
}
