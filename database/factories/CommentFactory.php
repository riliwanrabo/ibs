<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'public_ip' => fake()->ipv4(),
            'comment' => fake()->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Comment $comment) {
            $comment->book_id = array_rand(Book::pluck('id')->toArray());
        });
    }
}
