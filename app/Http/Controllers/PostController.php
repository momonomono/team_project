<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Pagination\Paginator;
use App\Enums\Category;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Article::query()
        ->search($request->search)
        ->category($request->category)
        ->orderBy('created_at', 'desc')
        ->paginate(6);

        $posts->appends($request->query());

        // カテゴリー一覧を取得
        $categories = Category::cases();

        return view('top', compact('posts', 'categories'));
    }
}
