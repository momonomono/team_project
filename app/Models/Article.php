<?php

namespace App\Models;

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
        
        // ID,　user_idから記事を取得
        return self::where('id', $id)
            ->where('user_id', $user_id)
            ->firstOrFail();
    }

    public function updateArticle($id, $postData)
    {
        
        
    }

    public function deleteArticle($id)
    {
        $user_id = Auth::id();

        $article = self::where('id', $id)
                    ->where('user_id', $user_id)
                    ->firstOrFail();
        
        Storage::disk('public')->delete($article->image_path);
        
        $article->delete();
    }
} 