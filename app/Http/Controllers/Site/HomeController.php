<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categories;
use App\Models\Link;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $articles = Article::paginate(config('blog.article_per_page'));
        foreach ($articles as &$article) {
            $cate = Categories::where('id', $article['category_id'])->first();
            $articleTags = ArticleTag::where('article_id', $article['id'])->get();
            $oneTags = [];
            foreach ($articleTags as $articleTag) {
                $oneTags[] = Tag::where('id', $articleTag['tag_id'])->first();
            }
            $user = User::where('id', $article['user_id'])->first();
            $article['user'] = $user;
            $article['tags'] = $oneTags;
            $article['cate'] = $cate;
        }

        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.index', compact('articles', 'cates', 'tags', 'links'));
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        $category = Categories::findOrFail($article['category_id']);
        $articleTags = ArticleTag::where('article_id', $id)->get();
        $tags = [];
        foreach ($articleTags as $articleTag) {
            $tags[] = Tag::where('id', $articleTag['tag_id'])->first();
        } unset($articleTag);
        $article['cate'] = $category;
        $article['tags'] = $tags;
        $user = User::where('id', $article['user_id'])->first();
        $article['user'] = $user;
        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.article', compact('article', 'cates', 'tags', 'links'));
    }

}
