<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // テストで使用
        // \App\Models\Article::create([
        //     'user_id' => 1,
        //     'title' => 'タイトル',
        //     'category_id' => 1,
        //     'content' => 'コンテンツです',
        //     'image_path' => 'images/a.png'
        // ]);  
        $this->call([
            UserSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}