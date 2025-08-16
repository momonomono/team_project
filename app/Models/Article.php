<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

     // カテゴリのキャスト
     protected $casts = [
        'category_id' => Category::class,
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image_path',
    ];

    // image_pathのアクセサ
    public function getImagePathAttribute($value)
    {
        return $value
            ? (app()->isProduction() ? Storage::disk('s3')->url($value) : asset('storage/' . $value))
            : null;
    }
    public static function getArticles(Request $request)
    {
        return static::query()
        ->search($request->search)
        ->category($request->category)
        ->orderBy('created_at', 'desc')
        ->paginate(9);
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
    
    // タイトル or コンテンツ検索スコープ
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!empty($term)) {
            $query->where(function ($q) use ($term) {
                $q->where('title', 'LIKE', "%{$term}%")
                  ->orWhere('content', 'LIKE', "%{$term}%");
            });
        }
        return $query;
    }

    // カテゴリー絞り込みスコープ
    public function scopeCategory(Builder $query, ?int $categoryId): Builder
    {
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        return $query;
    }
    // attributes for category
    // public function getCategoryAttribute()
    // {
    //     return Category::from($this->category_id)->label();
    // }

    // 自分の記事を取得するスコープ
    public function scopeByUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
} 