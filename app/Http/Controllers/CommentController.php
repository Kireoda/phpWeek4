<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required'
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'author_name' => $request->author_name,
            'content' => $request->content
        ]);

        return back();
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required'
        ]);

        $comment->update([
            'author_name' => $request->author_name,
            'content' => $request->content
        ]);

        return redirect()->route('posts.show', $comment->post_id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}