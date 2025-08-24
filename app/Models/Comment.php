<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメント作成
     * 
     * @param array $data
     * @return Comment
     */
    public static function createComment(array $data)
    {
        return self::create($data);
    }
} 