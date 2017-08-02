<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article_Tag;
use App\Models\ArticleTag;
use App\Models\Categories;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index() {
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
