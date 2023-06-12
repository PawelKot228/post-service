<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(CommentStoreRequest $request, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            ...$request->validated(),
        ]);

        return redirect()->back();
    }

    public function show(Comment $comment)
    {
    }

    public function edit(Post $post, $comment)
    {
        $comment = $post->comments()->findOrFail($comment);

        abort_if($comment->user_id !== auth()->id(), 403);

        return view('pages.comments.edit', compact('post', 'comment'));
    }

    public function update(CommentStoreRequest $request, Post $post, $comment): RedirectResponse
    {
        $comment = $post->comments()->findOrFail($comment);

        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->fill($request->validated())->save();

        return redirect()->back();
    }

    public function destroy(Post $post, $comment): RedirectResponse
    {
        $comment = $post->comments()->where('user_id', auth()->id())->findOrFail($comment);

        $comment->delete();

        return redirect()->back();
    }
}
