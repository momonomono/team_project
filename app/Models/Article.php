<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    // 自分の記事を取得するスコープ
    public function scopeByUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
} 