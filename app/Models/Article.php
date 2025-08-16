<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Category;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
} 