<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Enums\Category;

class PostController extends Controller
{

    public function index(Request $request) 
    {
        $articles = Article::getArticles($request);

        $articles->appends($request->query());

        // カテゴリー一覧を取得
        $categories = Category::cases();

        return view('top', compact('articles', 'categories'));
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
        $myPosts = Article::byUser()->paginate(6);
        return view('myPosts', compact('myPosts'));
    }
}
