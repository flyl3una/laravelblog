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

    public function index()
    {
        $articles = Article::where('state', 0)->orderBy('updated_at','desc')
        ->paginate(config('blog.article_per_page'));
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
        $groups = Article::where('state', 0)->selectRaw('year(updated_at)  year, count(*) count')
            ->groupBy('year')
            ->orderByRaw('min(updated_at) desc')->get();
        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.index', compact('articles', 'groups', 'cates', 'tags', 'links'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $category = Categories::findOrFail($article['category_id']);
        $articleTags = ArticleTag::where('article_id', $id)->get();
        $groups = Article::selectRaw('year(updated_at)  year, count(*) count')
            ->groupBy('year')
            ->orderByRaw('min(updated_at) desc')->get();
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
        return view('site.article', compact('article', 'groups', 'cates', 'tags', 'links'));
    }

    public function archive($select_year='0')
    {
        $groups1 = Article::where('state', 0)->selectRaw('year(updated_at)  year, month(updated_at) month, count(*) count')
            ->groupBy('year', 'month')
            ->orderByRaw('min(updated_at) desc')->get();
        $groups = Article::where('state', 0)->selectRaw('year(updated_at)  year, count(*) count')
            ->groupBy('year')
            ->orderByRaw('min(updated_at) desc')->get();
        $archives = [];
        foreach ($groups as $group) {
            $archives[$group['year']] = [];
        } unset($group);
        foreach ($groups1 as $group) {
            $year = $group['year'];
            $month = $group['month'];

            $archive = [];
            $archive['time'] = $year . ' / ' . $month;
            $archive['year'] = $year;
            $archive['month'] = sprintf('%2d', $month);
            if(strlen(strval($month)) == 1) {
                $month = '0'.strval($month);
            }
            $archive['month'] = $month;
            $archive['count'] = $group['count'];
            $like = '%'.$year.'-'.$month.'%';
            $articles = Article::where('state', 0)->where('updated_at', 'like', $like)
            ->orderBy('updated_at','desc')->get();
            $archive['articles'] = $articles;
            $archives[$year][$month] = $archive;
        }
        unset($group);
        unset($archive);

        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.archive', compact('archives', 'groups', 'cates', 'tags', 'links', 'select_year'));
    }

    public function category($id=0)
    {
        $id = intval($id);
        if($id == 0) {
            return 'id不能为0';
        }
        $articles = Article::where('category_id', $id)->where('state', 0)->paginate(config('blog.article_per_page'));
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
        $groups = Article::where('state', 0)->selectRaw('year(updated_at)  year, count(*) count')
            ->groupBy('year')
            ->orderByRaw('min(updated_at) desc')->get();
        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.category', compact('articles', 'groups', 'cates', 'tags', 'links'));
    }

    public function search($data)
    {
        if($data == "") {
            redirect(route('home.index'));
        }
        if($data.length >= 16) {
            redirect(route('home.index'));
        }

        $articles = Article::search($data)->where('state', 0)->paginate(config('blog.article_per_page'));
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
        $groups = Article::where('state', 0)->selectRaw('year(updated_at)  year, count(*) count')
            ->groupBy('year')
            ->orderByRaw('min(updated_at) desc')->get();
        $cates = Categories::all();
        $tags = Tag::all();
        $links = Link::all();
        return view('site.index', compact('articles', 'groups', 'cates', 'tags', 'links'));
    }
}
