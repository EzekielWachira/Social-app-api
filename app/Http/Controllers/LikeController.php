<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\LikesResource;
use App\Like;
use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index() {
        $like = Like::with('user', 'post')->orderByDesc('created_at')
            ->paginate(20);
        return LikesResource::collection($like);
    }

    public function store(Request $request, Post $post){
        $like = new Like();
        $like->user_id = $request->user()->id;
        $like->post_id = $post->id;
        $like->save();
        return new LikesResource($like);
    }

    public function delete(Like $like){
        $like->delete();
        return response([
            'message' => 'User Unliked the post'
        ]);
    }
}
