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
     *  新規記事を追加する
     * 
     * @param array $article
     * @return void
     */
    public function addNewArticle($article)
    {
        // ログインユーザーのIDを追加
        $article['user_id'] = Auth::id();

        // DBに登録
        self::create($article);
    }
} 