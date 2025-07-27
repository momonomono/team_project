<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    // attributes for category
    // public function getCategoryAttribute()
    // {
    //     return Category::from($this->category_id)->label();
    // }

    // カテゴリのキャスト
    protected $casts = [
        'category_id' => Category::class,
    ];
} 