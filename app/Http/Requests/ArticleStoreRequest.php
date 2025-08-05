<?php

namespace App\Http\Requests;

use App\Enums\Category;
use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
        return [
            "category_id" => "required|integer|between:1," . count(Category::cases()),
            "title" => "required|string|max:20",
            "content" => "required|string|max:2000",
            "image_path" => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }
}
