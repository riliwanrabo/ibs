<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isLocal()) {
            // Comment::factory()
            //     ->hasUser()
            //     ->hasBook()
            //     ->count(20)
            //     ->create();
        }
    }
}
