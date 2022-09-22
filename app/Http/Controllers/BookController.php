<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\StoreBook;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(public BookService $bookService)
    {
    }

    /**
     * Books
     * Lists of books with their respective comments and authors
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->all();

        return response()->json($books);
    }

    /**
     * Show Book Resource
     *
     * @param Book $book
     * @return Book
     */
    public function show(Book $book): Book
    {
        return $book;
    }

    /**
     * Create Book
     * Create a book resource attached to their authors
     *
     * @return JsonResponse
     */
    public function store(StoreBook $request): JsonResponse
    {
        $book = $this->bookService->create($request->validated());

        return response()->json($book, 201);
    }
}
