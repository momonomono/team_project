<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     *  表示記事が自身のものか確認
     *  
     *  @param int $id
     *  @return Article|redirect
     */
    public function checkOwnArticle($id)
    {
        // IDがない場合、新規投稿画面へ
        if (!$id) {
            return redirect()
                ->route("create.article");
        }

        // IDから記事を取得
        $article = self::findOrFail($id);
        $user_id = Auth::id();
        
        // 記事のユーザーIDと現在のユーザーIDを比較
        if ($article->user_id !== $user_id) {
            return redirect()
                ->route('top');
        }
        
        // 所有している記事を返す
        return $article;
    }

    public function updateArticle($id, $postData)
    {
        
        
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $article->delete();
    }
} 