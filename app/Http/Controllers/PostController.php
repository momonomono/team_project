<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * 新規投稿登録
     * 
     * @param ArticleRequest $request
     * @return
     */
    public function Article(ArticleStoreRequest $request)
    {   
        // DBに入れるデータを変数に挿入
        $todolists = $request->validated();
        $todolists['image_path'] = $request->file('image_path')->store('images', 'public');
        $todolists['user_id'] = Auth::id();

        // DBに登録
        Article::create($todolists);

        // トップ画面に戻る
        return redirect()
            ->route('top');
    }

    
}
