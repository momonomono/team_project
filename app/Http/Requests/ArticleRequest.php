<?php

namespace App\Http\Requests;

use App\Enums\Category;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 画像のバリデーションルール
        // 新規投稿画面で分岐
        if ($this->path() === 'post/create') {
            $image_path_rule = 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048';
        // 更新画面で分岐
        } else {
            $image_path_rule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048';
        }
        return [
            "title" => "required|string|max:20",
            "image_path" => $image_path_rule,
            "category_id" => "required|integer|between:1," . count(Category::cases()),
            "content" => "required|string|max:2000",
        ];
    }
}
