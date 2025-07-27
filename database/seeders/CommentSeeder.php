<?php

Namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'article_id' => 1,
                'user_id' => 1,
                'content' => 'これはサンプルコメント1です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article_id' => 2,
                'user_id' => 1,
                'content' => 'これはサンプルコメント2です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}