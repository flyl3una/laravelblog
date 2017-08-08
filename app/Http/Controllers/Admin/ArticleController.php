<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categories;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mews\Purifier\Purifier;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articleAll = Article::paginate(config('blog.article_list_number'));;
        $articleList = Array();

        foreach ($articleAll as $articleOne) {
            $user = User::where('id', $articleOne['user_id'])->select('name')->firstOrFail();
            $cate = Categories::where('id', $articleOne['category_id'])->select('name')->firstOrFail();
            $tagIds = ArticleTag::where('article_id', $articleOne['id'])->get();
            $tags = Array();
            foreach ($tagIds as $tagId) {
                $tag = Tag::where('id', $tagId['tag_id'])->select('name')->first();
                $tags[] = $tag['name'];
            }

            $article = Array();
            $article['id'] = $articleOne['id'];
            $article['user'] = $user['name'];
            $article['cate'] = $cate['name'];
            $article['tags'] = $tags;
//            $article['name'] = $articleOne['name'];
            $article['title'] = $articleOne['title'];
            $article['click_count'] = $articleOne['click_count'];

            $articleList[] = $article;
        }
        return view('admin.article.index', compact('articleList', 'articleAll'));
//        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        return 'create';
        $cates = Categories::all();
        $tagAll = Tag::all();
        return view('admin.article.edit', compact( 'cates', 'tagAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        //
//        $markdownContent = $request['markdown_content'];
        Purifier::clean($request['markdown_content']);
        Article::insert(['title' => $request['title'], 'description' => $request['description'], 'markdown_content' => $request['markdown_content'],
            'html_content' => $request['markdown_content']]);
        return 'store success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
//        return 'edit' . $id;
        $article = Article::where('id', $id)->firstOrFail();
        $cate = Categories::where('id', $article['category_id'])->firstOrFail();
        $tagIds = ArticleTag::where('article_id', $article['id'])->get();
        $tags = Array();
        foreach ($tagIds as $tagId) {
            $tag = Tag::where('id', $tagId['id'])->first();
            $tags[] = $tag;
        }
        $cates = Categories::all();
        $tagAll = Tag::all();
        return view('admin.article.edit', compact('article', 'cate', 'tags', 'cates', 'tagAll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $id = intval($id);
        $tagIds = $request['tags'];
        ArticleTag::where('article_id', $id)->delete();
        foreach ($tagIds as $tagId) {
            $tagId = intval($tagId);
            ArticleTag::insert(['article_id' => $id, 'tag_id' => $tagId]);
        }
        Article::where('id', $id)->update(['title' => $request['title'], 'description' => $request['description'],
            'markdown_content' => $request['markdown_content'], 'html_content' => $request['markdown_content']]);
        return 'update success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
//        return 'destroy' . $id;
        $id = intval($id);
        ArticleTag::where('article_id', $id)->delete();
        Article::where('id', $id)->delete();
        return 'destroy success';
    }
}
