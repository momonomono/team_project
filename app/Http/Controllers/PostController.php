<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    public function index() {
        $posts = Article::orderBy('created_at', 'desc')->paginate(6);
        return view('top', compact('posts'));
    }
}
