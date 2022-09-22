<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
     * All Comments
     * Retrieve comments with search functionality
     *
     */
    public function all()
    {
        $comments = Comment::latest('created_at');

        if (request()->has('search') && request()->filled('search')) {
            $searchString = request()->get('search');
            $comments->whereLike(['comment', 'timezone'], $searchString);
        }

        return $comments->paginate();
    }

    public function create(array $payload): Comment
    {
        return Comment::create($payload);
    }

    /**
     * Delete Comment
     * Forceful/Completely delete a comment from the database
     *
     * @param [type] $id Primary key on comments
     */
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->forceDelete();

        return $comment;
    }
}
