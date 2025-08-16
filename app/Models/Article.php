<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Enums\Category;
use Illuminate\Support\Facades\Storage;

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

    // カテゴリのキャスト
    protected $casts = [
        'category_id' => Category::class,
    ];

    // image_pathのアクセサ
    public function getImagePathAttribute($value)
    {
        return $value
            ? (app()->isProduction() ? Storage::disk('s3')->url($value) : asset('storage/' . $value))
            : null;
    }

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