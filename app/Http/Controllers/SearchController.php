<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Enums\Category;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = Article::query();

        // 検索機能（titleとdetailから検索）
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }

        // カテゴリー絞り込み
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 投稿を取得（ページネーション付き）
        $posts = $query->orderBy('created_at', 'desc')->paginate(6);

        // 検索パラメータをページネーションに引き継ぐ
        $posts->appends($request->query());

        // カテゴリー一覧を取得
        $categories = Category::cases();

        return view('top', compact('posts', 'categories'));
    }
}

