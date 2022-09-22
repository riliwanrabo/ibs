<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Http\Requests\Authors\StoreAuthor;

class AuthorController extends Controller
{
    public function __construct(public AuthorService $authorService)
    {
    }

    /**
     * Authors
     * Lists of author with their books if any
     *
     * @return JsonResponse
     */
    public function index()
    {
        $author = $this->authorService->all();

        return response()->json($author);
    }

    /**
     * Create Author
     * Create a author resource attached to their authors
     *
     * @return JsonResponse
     */
    public function store(StoreAuthor $request)
    {
        $author = $this->authorService->create($request->validated());

        return response()->json($author, 201);
    }

    /**
     * Show Author Resource
     *
     * @param Author $author
     * @return Author
     */
    public function show(Author $author): Author
    {
        return $author;
    }
}
