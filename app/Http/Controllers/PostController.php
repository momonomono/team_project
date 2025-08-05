<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createArticle()
    {
        $categories = Category::cases();

        return view("create")
            ->with(compact("categories"));
    }

    public function storeArticle(ArticleStoreRequest $request)
    {   
        $todolists = $request->validated();
        $todolists['image_path'] = $request->file('image_path')->store('images', 'public');
        $todolists['user_id'] = Auth::id();

        Article::create($todolists);

        return redirect()
            ->route('top');
    }

    
}
