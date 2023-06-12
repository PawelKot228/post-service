<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('cover')
            ->withCount('comments')
            ->where('status', 1)
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('pages.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('pages.posts.create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $post = $user->posts()->create($request->validated());

        return to_route('posts.edit', [$post]);
    }

    public function show($post)
    {
        $post = Post::with(['comments', 'cover', 'gallery'])
            ->withCount('comments')
            ->findOrFail($post);

        abort_if($post->status !== 1, 404);

        return view('pages.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        return view('pages.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $post->fill($request->validated())->save();

        return to_route('posts.edit', [$post]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return to_route('posts.index');
    }
}
