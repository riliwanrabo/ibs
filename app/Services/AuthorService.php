<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    /**
     * Fetch all authors
     * Retrieve books sorted by their names
     * Pass a search term to your request object using the key "search" to enable filtering columns
     *
     */
    public function all()
    {
        $authors = Author::with('books')->withCount('books')
            ->orderBy('first_name');

        if (request()->has('search') && request()->filled('search')) {
            $searchString = request()->get('search');
            $authors->whereLike(['name', 'country', 'isbn', 'release_date', 'publisher'], $searchString);
        }

        return $authors->paginate(request()->get('limit'));
    }

    /**
     * Create a Author Resource
     *
     * @param array $payload
     * @return Author
     */
    public function create(array $payload): Author
    {
        return Author::create($payload);
    }
}
