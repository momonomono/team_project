<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // image_pathのアクセサ
    public function getImagePathAttribute($value)
    {
        return $value
            ? (app()->isProduction() ? Storage::disk('s3')->url($value) : asset('storage/' . $value))
            : null;
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

    // 自分の投稿絞り込みスコープ
    public function scopeByUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    /**  記事一覧の取得
     *  
     *  @param Request $request
     *  @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getArticles(Request $request)
    {
        return static::query()
            ->search($request->search)
            ->category($request->category)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    /**  自分の投稿一覧の取得
     *  
     *  @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getMyPosts()
    {
        return static::byUser()
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    /**
     *  表示記事が自身のものか確認
     *  
     *  @param int $id
     *  @return Article|redirect
     */
    public function checkOwnArticle($id)
    {
        // ユーザーIDを取得
        $user_id = Auth::id();
        
        // ID, user_idから記事を取得
        return self::where('id', $id)
            ->where('user_id', $user_id)
            ->firstOrFail();
    }

    /**
     * 新規記事を追加する
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

    /**
     * 記事の削除
     * 
     * @param int $id
     * @return void
     */
    public function deleteArticle($id)
    {
        // ユーザーID
        $user_id = Auth::id();

        // ID, user_idから記事を取得
        $article = self::where('id', $id)
                    ->where('user_id', $user_id)
                    ->firstOrFail();
        
        // 環境を調べ、保存先を変える
        $disk = app()->isProduction() ? "s3" : "public";
        Storage::disk($disk)->delete($article->image_path);
        
        // 削除する
        $article->delete();
    }
} 