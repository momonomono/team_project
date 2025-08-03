<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'user_id' => 1,
                'title' => 'サンプル記事1',
                'content' => 'これはサンプル記事1の本文です。テスト用のデータです。',
                'category_id' => 1,
                'image_path' => 'images/sample1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'サンプル記事2',
                'content' => 'これはサンプル記事2の本文です。複数行のテキストを含みます。',
                'category_id' => 2,
                'image_path' => 'images/sample2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'サンプル記事3',
                'category_id' => 3,
                'content' => 'これはサンプル記事3の本文です。画像はオプションです。',
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}