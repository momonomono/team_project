<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    public function myPosts() {
        $myPosts = Article::where('user_id', auth()->user()->id)->paginate(6);
        return view('myPosts', compact('myPosts'));
    }
}