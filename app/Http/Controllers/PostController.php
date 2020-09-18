<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index(){
        $posts = Post::with('user', 'comments.user', 'likes.user')
            ->orderBy('created_at', 'desc')->paginate(20);
        return PostResource::collection($posts);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->hasFile('image')) {
            $post->image = time().'_'.$request->file('image')->getClientOriginalName();
//            Storage::putFile('images', $request->file('image'), 'public');
            Storage::putFileAs('images', $request->file('image'),
                time()."_".$request->file('image')->getClientOriginalName(), 'public');
        }

        $post->save();

        return response([
            'message' => 'Post Successfully published'
        ]);
    }

    public function show($id){
        $post = Post::where('id', $id)->with('user', 'comments.user', 'likes.user')->first();
        if ($post) {
            return new PostResource($post);
        }else{
            return response([
                'message' => 'Post not found!!!'
            ]);
        }
    }

    public function update(Post $post, Request $request){
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required'
//        ]);

        if ($request->hasFile('image')) {
            $data = [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $request->file('image')->getClientOriginalName()
            ];
        }else{
            $data = [
                'title' => $request->title,
                'body' => $request->body
            ];
        }
        $post->update($data);

        return new PostResource($post);
    }

    public function delete($id){
//        $post->delete();
//        return new PostResource($post);
        Post::where('id', $id)->with('user', 'comments.user', 'likes.user')->first()->delete();
//        $post->delete();
        return response([
            'message' => 'post was deleted'
        ]);

    }
}
