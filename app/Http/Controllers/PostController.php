<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

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
        $articles = Article::getArticles($request);

        $articles->appends($request->query());

        // カテゴリー一覧を取得
        $categories = Category::cases();

        return view('top', compact('articles', 'categories'));
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

    /**
     * 詳細画面
     *
     * @param  int  $id
     * @return 
     */
    public function show($id)
    {
        // 記事の取得
        $article = Article::findOrFail($id);

        return view('show')->with(compact('article'));
    }

    /**
     * コメントを保存
     *
     * @param  \Illuminate\Http\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(CommentRequest $request, $id)
    {
        // コメント保存
        $comment = new Comment();
        $comment->article_id = $id;
        $comment->user_id = auth()->id();
        $comment->content = $request->input('comment');
        $comment->save();

        // 確認用にリダイレクト
        return back()->with('success', 'コメントを投稿しました。');
    }
}
