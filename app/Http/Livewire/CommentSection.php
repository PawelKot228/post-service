<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;

    public int|string $postId;

    public function render()
    {
        $post = Post::findOrFail($this->postId);
        $comments = $post->comments()
            ->with(['comments', 'user'])
            ->paginate(5);

        return view('livewire.comment-section', compact('comments', 'post'));
    }
}
