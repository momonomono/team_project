<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Enums\Category;
use App\Models\Comment;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * 編集画面
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editArticle($id)
    {
        // IDがない場合、新規投稿画面へ ある場合、記事を取得
        $article = (new Article())->checkOwnArticle($id);

        // カテゴリーの取得
        $categories = Category::cases();

        return view("edit", compact('categories', 'article'));
    }


    /**
     * 記事の新規登録
     * 
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArticle(ArticleRequest $request, $id)
    {   
        // 新規投稿画面へ ある場合、記事を取得
        $article = (new Article())->checkOwnArticle($id);
    
        // バリデーションを通過したデータを取得
        $postData = $request->validated();

        // 画像がアップロードされている場合、保存
        if ($request->hasFile('image_path')) {
            $disk = app()->isProduction() ? 's3' : 'public';
            $postData['image_path'] = $request->file('image_path')->store('images', $disk);
        // 画像がアップロードされていない場合、既存の画像パスを保持
        } else {
            $postData['image_path'] = $article->getRawOriginal('image_path');
        }

        // 記事の更新
        $article->update($postData);

        return back();
    }


    /**
     * 記事の削除
     * 
     * @param ArticleDeleteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteArticle(Request $request)
    {   
        // リクエストからIDを取得
        $id = $request->id;

        $article = new Article();

        // 記事を削除
        $article->deleteArticle($id);
        
        return redirect()
            ->route('top');
    }

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

    public function index(Request $request) 
    {
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

        if ($request->hasFile('image_path')) {
            // 開発環境に合わせた画像の保管
            $disk = app()->isProduction() ? "s3" : "public";
            $article['image_path'] = $request->file('image_path')->store('images', $disk);
        }

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
     * @param  CommentRequest  $request
     * @param  int  $id
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

    public function myPosts() {
        $myPosts = Article::getMyPosts();
        return view('myPosts', compact('myPosts'));
    }
}
