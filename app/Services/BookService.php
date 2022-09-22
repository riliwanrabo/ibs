<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    /**
     * Fetch all books
     * Retrieve books sorted by their release dates in ascending
     * This method eagerloads comments and authors
     * Pass a search term to your request object using the key "search" to enable filtering columns
     *
     */
    public function all()
    {
        $books = Book::earlierReleased()
            ->withCount('comments', 'authors')
            ->orderBy('name');

        if (request()->has('search') && request()->filled('search')) {
            $searchString = request()->get('search');
            $books->whereLike(['name', 'country', 'isbn', 'release_date', 'publisher'], $searchString);
        }

        return $books->paginate(request()->get('limit'));
    }

    /**
     * Create a Book Resource
     *
     * @param array $payload
     * @return Book
     */
    public function create(array $payload): Book
    {
        return Book::create($payload);
    }
}
