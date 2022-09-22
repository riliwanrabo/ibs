<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        $comment->timezone = now()->timezone;
        $comment->public_ip = get_public_ip();
    }
}
