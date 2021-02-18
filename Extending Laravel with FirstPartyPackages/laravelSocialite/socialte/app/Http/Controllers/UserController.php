<?php

namespace App\Http\Controllers;

use App\Models\User;
Use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_posts($id){
        $posts = Post::where('user_id', $id)->where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
        $title = User::find($id)->name;
        return view('home')->withPosts($post)->withTitle($title);
    }
    public function user_posts_all(Request $request){
        $user = $request->user();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($post)->withTitle($title);
    }
    public function user_posts_draft($id){
        $user = $request->user();
        $posts = Post::where('user_id', $id)->where('active', 0)->orderBy('created_at', 'desc')->paginate(5);
        $title = User::find($id)->name;
        return view('home')->withPosts($post)->withTitle($title);
    }
    public function profile(Request $request, $id){
        $data['user'] = User::find($id);
        if(!$data['user']){
            return redirect('/');
        }
        if($request->user() && $data['user'] -> id == $request->user()->id){
            $data['author'] = true;
        }else{
            $data['author'] = null;
        }

        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->comments->count();
        $data['comments_count'] = $data['user']->comments->count();
        $data['comments_count'] = $data['user']->comments->count();
        $data['comments_count'] = $data['user']->comments->count();
    }
}

