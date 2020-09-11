<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return PostResource::collection($posts);
    }

    public function store(Request $request){
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->file('image')->getClientOriginalName()
        ]);

        return response([
            'message' => 'Post Successfully published'
        ]);
    }

    public function show(Post $post){
        
    }

    public function update(Post $post, Request $request){

    }

    public function delete(Post $post){

    }
}
