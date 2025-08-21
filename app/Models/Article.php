<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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