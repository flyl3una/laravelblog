<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categories;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
//    显示已经发布的文章
    public function index(Request $request)
    {
        if (!$request->has('state')) {
            $state = -1;
            $articleAll = Article::orderBy('updated_at', 'desc')->paginate(config('blog.admin_per_number'));
        } else {
            $state = $request['state'];
            $state = intval($state);
            $articleAll = Article::where('state', $state)->orderBy('updated_at', 'desc')->paginate(config('blog.admin_per_number'));
        }
        $currentTab = $state;
//        $articlePublished = Article::where('state', config('blog.number.publish'))->paginate(config('blog.admin_per_number'));
//        $articleDraft = Article::where('state', config('blog.number.draft'))->paginate(config('blog.admin_per_number'));
        $articleList = Array();
//        $articleMap = ["all" => [], "published" => [], "draft" => []];
        $count = [];
        $count['published'] = Article::where('state', config('blog.number.publish'))->count();
        $count['draft'] = Article::where('state', config('blog.number.draft'))->count();
        $count['all'] = $count['published'] + $count['draft'];
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
            $article['title'] = $articleOne['title'];
            $article['click_count'] = $articleOne['click_count'];

            $articleList[] = $article;
        }
        return view('admin.article.index', compact('articleList', 'articleAll', 'currentTab', 'count'));
    }

    public function published(Request $request)
    {
        $request['state'] = 0;
        return $this->index($request);
    }

    public function draft(Request $request)
    {
        $request['state'] = 1;
        return $this->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates = Categories::all();
        $tagAll = Tag::all();
        return view('admin.article.create', compact('cates', 'tagAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        $title = $request['title'];
        $description = $request['description'];
        $cate = $request['category'];
        $tags = $request['tags'];
        $md = $request['editormd-markdown-doc'];
        $html = $request['editormd-html-code'];
        $state = 0;
        if ($request->has('draft')) {
            $state = 1;
        }

        if (!$title or !$description or !$md or !$html) {
            $data = ['code' => config('error.code.article.not_null'), 'info' => '文章标题，描述，目录，内容不能为空'];
            $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
            return $js;
        }
        if (!$cate) {
            $cate = 1;
        }
        $userid = Auth::user()->id;

//      使用 new Model 然后进行save，此方法可以自动更新timestamps
        $article = new Article();
        $article->user_id = $userid;
        $article->category_id = $cate;
        $article['title'] = $title;
        $article->description = $description;
        $article->markdown = $md;
        $article->html = $html;
        if ($state == 0) {
            $article['published_at'] = Carbon::now();
        }
        $article->state = $state;
        $article->save();
        $articleId = $article['id'];
        if ($state == 0) {
            Categories::where('id', $cate)->update(['count' =>
                Article::where('category_id', $cate)->where('state', config('blog.number.publish'))->count()]);
            if ($tags) {
                foreach ($tags as $tagId) {
                    ArticleTag::insert(['article_id' => $articleId, 'tag_id' => $tagId]);
                }
                unset($tagId);
            }
        }
        $data = ['code' => config('error.code.success'), 'info' => '文件创建成功', "url" => route('article.index')];
        $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
        return $js;
    }

//    此方法已废弃，本来为上传文章，后改为后台直接编辑
    public function store1(Request $request)
    {
        $title = $request['title'];
        $description = $request['description'];
        $cate = $request['category'];
        $tags = $request['tags'];
        $file = $request->file('md_file');
        $filename = $request['file_name'];

        // 文件是否上传成功
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名

            $realPath = $file->getRealPath();   //临时文件的绝对路径

        }
//        $this->validate($ext, 'md');
        if ($ext != 'md') {
            $data = ['code' => config('error.code.article.file_ext_error'), 'info' => '只能上传后缀为md的文件'];
            $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
            return $js;
        }
        // 上传文件
        $filename = date('Y-m-d') . '-' . uniqid() . '.' . $ext;
        // 使用我们新建的uploads本地存储空间（目录）
        $bool = Storage::disk('posts')->put($filename, file_get_contents($realPath));
        $userid = Auth::user()->id;
        $articleId = Article::insertGetId(['user_id' => $userid, 'category_id' => $cate, 'title' => $title, 'description' => $description,
            'filename' => $filename, 'state' => 0]);
        foreach ($tags as $tagId) {
            ArticleTag::insert(['article_id' => $articleId, 'tag_id' => $tagId]);
        }
        unset($tagId);

//        return redirect(route('article.index'));
        $data = ['code' => config('error.code.success'), 'info' => '文件创建成功', "url" => route('article.index')];
        $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
        return $js;
        //所有参数均为过滤
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        $cate = Categories::where('id', $article['category_id'])->firstOrFail();
        $articleTags = ArticleTag::where('article_id', $id)->get();
        $tags = [];
        foreach ($articleTags as $articleTag) {
            $tags[] = Tag::where('id', $articleTag['tag_id'])->firstOrFail();
        }unset($articleTag);
        $article['cate'] = $cate;
        $article['tags'] = $tags;
        return view('admin.article.show', compact('article', 'cate', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        $cate = Categories::where('id', $article['category_id'])->firstOrFail();
        $tagIds = ArticleTag::where('article_id', $article['id'])->get();
        $tags = Array();
        if ($tagIds) {
            foreach ($tagIds as $tagId) {
                $tag = Tag::where('id', $tagId['tag_id'])->first();
                $tags[] = $tag;
            }unset($tagId);
        }
        $cates = Categories::all();
        $tagAll = Tag::all();
        return view('admin.article.edit', compact('article', 'cate', 'tags', 'cates', 'tagAll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request['title'];
        $description = $request['description'];
        $cate = $request['category'];
        $tags = $request['tags'];
        $md = $request['editormd-markdown-doc'];
        $html = $request['editormd-html-code'];
        $state = 0;
        if ($request->has('draft')) {
            $state = 1;
        }
        if (!$title or !$description or !$md or !$html) {
            $data = ['code' => config('error.code.article.not_null'), 'info' => '文章标题，描述，目录，内容不能为空'];
            $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
            return $js;
        }
        if (!$cate) {
            $cate = 1;
        }
        $userid = Auth::user()->id;
        $article = Article::where('id', $id)->first();
        $article['category_id'] = $cate;
        $article['title'] = $title;
        $article['description'] = $description;
        $article['markdown'] = $md;
        $article['html'] = $html;
        $article['state'] = $state;
        if ($state == 0 and !$article['published_at']) {
            $article['published_at'] = Carbon::now();
        }
        if (!$article->update()) {
            $data = ['code' => config('error.code.article.update_fail'), 'info' => '更新失败'];
            $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
            return $js;
        }
        if ($state == 0) {
            Categories::where('id', $cate)->update(['count' =>
                Article::where('category_id', $cate)->where('state', config('blog.number.publish'))->count()]);
            ArticleTag::where('article_id', $id)->delete();
            if ($tags){
                foreach ($tags as $tagId) {
                    ArticleTag::insert(['article_id' => $id, 'tag_id' => $tagId]);
                }unset($tagId);
            }
        }

        $data = ['code' => config('error.code.success'), 'info' => '文件创建成功', "url" => route('article.index')];
        $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
        return $js;
    }

//    此方法已废弃，作用为更新上传的文件。
    public function update1(Request $request, $id)
    {
        //
        $id = intval($id);
        $title = $request['title'];
        $description = $request['description'];
        $cate = $request['category'];
        $tags = $request['tags'];
        $file = $request->file('md_file');
        $filename = $request['file_name'];
        // 文件是否上传成功
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
        }
        if ($ext != 'md') {
            $data = ['code' => config('error.code.article.file_ext_error'), 'info' => '只能上传后缀为md的文件'];
            $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
            return $js;
        }
        // 上传文件
        $filename = date('Y-m-d') . '-' . uniqid() . '.' . $ext;
        // 使用我们新建的uploads本地存储空间（目录）
        $bool = Storage::disk('posts')->put($filename, file_get_contents($realPath));
        $userid = Auth::user()->id;
        $articleId = Article::where('id', $id)->update(['user_id' => $userid, 'category_id' => $cate, 'title' => $title, 'description' => $description,
            'filename' => $filename, 'state' => 0]);
        ArticleTag::where('article_id', $id)->delete();
        foreach ($tags as $tagId) {
            ArticleTag::insert(['article_id' => $articleId, 'tag_id' => $tagId]);
        }
        unset($tagId);

        $data = ['code' => config('error.code.success'), 'info' => '文件创建成功', "url" => route('article.index')];
        $js = '<script>window.parent.showCreateResult(' . json_encode($data) . ')</script>';
        return $js;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return 'destroy' . $id;
        $id = intval($id);
//        return 'destroy success';
        try {
            ArticleTag::where('article_id', $id)->delete();
            Article::where('id', $id)->delete();
            Categories::where('id', 1)->update(['count' => Article::where('category_id', 1)->count()]);
            $data = ['code' => config('error.code.success'), 'info' => '删除成功'];
        } catch (Exception $e) {
            $data = ['code' => config('error.code.article.delete_fail'), 'info' => '删除失败'];
            echo $e;
        }
        $js = '<script>window.parent.promptDeleteResult(' . json_encode($data) . ')</script>';
        return $js;
    }

//    移至回收站，目前没有使用。
    public function moveToTrash(Request $request)
    {
        $ids = $request['ids'];
        $option = $request['option_number'];

        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            $id = intval($id);
            try {
                Article::where('id', $id)->update(['state' => config('blog.number.trash')]);
                $cate_id = Article::where('id', $id)->first()['category_id'];
                Categories::where('id', $cate_id)->update(['count' =>
                    Article::where('category_id', $cate_id)->where('state', config('blog.number.publish'))->count()]);
                $data = ['code' => config('error.code.success'), 'info' => '删除成功'];
            } catch (Exception $e) {
                $data = ['code' => config('error.code.article.delete_fail'), 'info' => '删除失败'];
                echo $e;
            }
        }
        if (intval($option) == 1) {
            return json_encode($data);
        } else {
            $js = '<script>window.parent.promptDeleteResult(' . json_encode($data) . ')</script>';
            return $js;

        }
    }
}
