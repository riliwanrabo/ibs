<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreComment;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
        $this->middleware('jwt');
    }

    /**
     * Comments
     * Lists of comments in chronological order
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = $this->commentService->all();

        return response()->json($comments);
    }

    /**
     * Create Comment
     * Comment on a book
     *
     * @param StoreComment $request
     * @return JsonResponse
     */
    public function store(StoreComment $request): JsonResponse
    {
        $comment = $this->commentService->create($request->validated());

        return response()->json($comment, 201);
    }

    /**
     * Show Comment Resource
     *
     * @param Comment $comment
     * @return Comment
     */
    public function show(Comment $comment): Comment
    {
        return $comment;
    }

    /**
     * Archive Comment
     * Trash a comment
     *
     * @param [type] $id
     * @return JsonResponse|null
     */
    public function destroy($id): mixed
    {
        $this->commentService->delete($id);
        return response()->noContent();
    }
}
