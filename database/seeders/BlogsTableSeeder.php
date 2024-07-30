<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'title' => 'First Blog Post',
                'content' => 'This is the content of the first blog post.',
                'author' => 'John Doe',
                'published_at' => now(),
            ],
            [
                'title' => 'Second Blog Post',
                'content' => 'This is the content of the second blog post.',
                'author' => 'Jane Smith',
                'published_at' => now()->subDays(1),
            ],
            // Add more blog posts as needed
        ]);
    }
}
