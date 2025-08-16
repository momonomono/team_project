<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class PostController extends Controller
{

    /**
     * 新規投稿画面
     * 
     * @param 
     * @return
     */
    public function createArticle()
    {
        // カテゴリーのセレクター用データ
        $categories = Category::cases();

        return view("create")
            ->with(compact("categories"));
    }

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

    /**
     * 新規投稿登録
     * 
     * @param ArticleRequest $request
     * @return
     */
    public function storeArticle(ArticleRequest $request)
    {   
        // DBに入れるデータを変数に挿入
        $article = $request->validated();
        // 画像の保管
        $article['image_path'] = $request->file('image_path')->store('images', 'public');
        
        // 新規記事を追加
        ( new Article() )->addNewArticle($article);

        // トップ画面に戻る
        return redirect()->route('top');
    }

    
}
