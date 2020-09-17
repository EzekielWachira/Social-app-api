<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index(){
        $comment = Comment::with('user', 'post')->orderBy('created_at', 'desc')
            ->paginate(20);
        return CommentResource::collection($comment);
    }

    public function show($id){
        $comment = Comment::findOrFail($id)->with('user', 'post')->first();
        return new CommentResource($comment);
    }

    public function store(Request $request, Post $post) {
        $request->validate([
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->post_id = $post->id;
        $comment->body = $request->body;

        $comment->save();
        return new CommentResource($comment);
    }

    public function update(Request $request, Comment $comment){
        $data = [
            'body' => $request->body
        ];
        $comment->update($data);
        return new CommentResource($comment);
    }

    public function delete(Comment $comment){
        if ($comment) {
            $comment->delete();
            return response([
                'message' => 'comment was deleted'
            ]);
        }else{
            return response([
                'message' => 'Comment regarding to that post could not be found'
            ]);
        }
    }
}
