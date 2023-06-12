<div>
    @foreach($comments as $comment)
        <x-comment :comment="$comment" :post="$post" />

        @foreach($comment->comments as $threadComment)
            <x-comment-reply :comment="$threadComment" :post="$post" />
        @endforeach

    @endforeach

    {!! $comments->links() !!}
</div>
