<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Pagination\Paginator;
use App\Enums\Category;

class PostController extends Controller
{
    public function index(Request $request) {
        $articles = Article::getArticles($request);

        $articles->appends($request->query());

        // カテゴリー一覧を取得
        $categories = Category::cases();

        return view('top', compact('articles', 'categories'));
    }
}
