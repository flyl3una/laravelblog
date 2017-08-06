<?php

namespace App\Http\Controllers\Site;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categories;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    //
    public function index()
    {
        $articles = Article::paginate(config('blog.article_per_page'));
        $cates = Categories::all();
        $tags = Tag::all();

        return view('site.index', compact('articles', 'cates', 'tags'));
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        $category = Categories::findOrFail($article['id']);
        $tags = ArticleTag::where('article_id', $article['id']);
        return view('site.article', compact('article', 'category', 'tags'));
    }
}
