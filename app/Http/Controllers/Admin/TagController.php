<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::paginate(config('blog.admin_per_number'));
        $tagCount = [];
        foreach ($tags as $tag) {
            $id = $tag['id'];
            $tagCount[$id] = ArticleTag::where('tag_id', $tag['id'])->count();
        }
        return view('admin.tag.index', compact('tags', 'tagCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $name = trim($request['name']);
//        Tag::insert(['name' => trim($name)]);
        $tag = new Tag();
        $tag['name'] = $name;
        $tag->save();
        return redirect(route('tag.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id = intval($id);
        $name = trim($request['name']);
        try {
            $tag = Tag::where('id', $id)->first();
            $tag['name'] = $name;
            $tag->update();
            $data = ['code' => 0, 'info' => '更新成功'];
        } catch (Exception $e) {
            $data = ['code' => 1, 'info' => '更新失败'];
        }
        $js = "<script>window.parent.promptChangeResult(" . json_encode($data) . ")</script>";
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
        //
        $id = intval($id);
        try {
            ArticleTag::where('tag_id', $id)->delete();
            Tag::where('id', $id)->delete();
            $data = ['code' => config('error.code.success'), 'info' => '删除成功'];
        } catch (Exception $e) {
            $data = ['code' => config('error.code.cate.delete_fail'), 'info' => '删除失败'];
        }
        $js = '<script>window.parent.promptDeleteResult(' . json_encode($data) . ')</script>';
        return $js;
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request['ids'];
        $ids = explode(',', $ids);
        $length = count($ids);
        $index = 0;
        foreach ($ids as $id) {
            $id = intval($id);
            ArticleTag::where('tag_id', $id)->delete();
            Tag::where('id', $id)->delete();
            $index++;
        }
        if ($index == $length) {
            $data = ['code' => config('error.code.success'), 'info' => '所选标签删除成功'];
        } else {
            $data = ['code' => config('error.code.success'), 'info' => '成功删除' . $index . '个标签,有' . ($length - $index) . '没有删除'];
        }
        return json_encode($data);
    }
}
