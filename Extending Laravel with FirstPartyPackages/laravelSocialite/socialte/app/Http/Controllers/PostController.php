<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Request\PostFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('active', 1)->orderBy('created_at', 'desc')->paginate(25);
        // page heading
        $title = 'Latest Post';
        return view('posts.index', compact('posts'))->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user()->can_post()){
            return view('posts.create');
        }else {
            return redirect('/')->withErrors('You have not sufficient permissions for writing posts');
        }
        // return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|max:255',
        //     'body' => 'required|min:5|max:10000'
        // ]);
        $user = auth()->user();

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->get('body');
        $post->image = $request->get('image');
        $post->category = $request->get('category');
        $post->featured = $request->featured;
        $post->published_at = $request->published_at;
        $post->user_id = $request->user()->id;


        if($request->has('save')){
            $post->active = 0;
            $message = 'Post saved successfully';
        }else{
            $post->active = 1;
            $message = 'Post is published successfully';
        }
        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        if($post && ($request->user()->id == $post->user_id) || $request->user()->is_admin())
            return view('post.edit', compact('post'));
        return redirect('/')->withErrors('you have nog sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->published_at = $request->published_at;

        $post->save();
        return redirect('/home')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post && ($post->user_id == $request->user()->id || $request->user()->is_admin())){
            $post->delete();
            $data['message'] = 'Post deleted successfully';
        }else{
            $data['errors'] = 'invalid operation you have not sufficient permissions';
        }

        return redirect('/home')->with($data);
    }
}
