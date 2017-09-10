<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cates = Categories::paginate(config('blog.admin_per_number'));
        return view('admin.categories.index', compact('cates'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $name = $request['cateName'];
        $name = trim($name);
//        Categories::insert(['name' => trim($name)]);
        try {
//            Categories::insert(['name' => trim($name)]);
            $cate = new Categories();
            $cate['name'] = $name;
            $cate->save();
            $data = ['code' => 0, 'info' => '添加成功'];
        } catch(Exception $e) {
            $data = ['code' => 1, 'info' => '更新失败'];
        }
//        $js = "<script>window.parent.promptAddResult(".json_encode($data).")</script>";
//        return $js;
        return redirect(route('categories.index'));
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
        $name = trim($request['name']);
        try {
//            Categories::where('id', $id)->update(['name' => $name]);
            $cate = Categories::where('id', $id)->first();
            $cate['name'] = $name;
            $cate->update();
            $data = ['code' => 0, 'info' => '更新成功'];
        } catch(Exception $e) {
            $data = ['code' => 1, 'info' => '更新失败'];
        }
        $js = "<script>window.parent.promptChangeResult(".json_encode($data).")</script>";
        return $js;
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
        $id = intval($id);
        if($id == 1) {
            $data = ['code' => config('error.code.cate.cannot_delete_root'), 'info' => '不能删除根目录'];
            $js = "<script>window.parent.promptDeleteResult(".json_encode($data).")</script>";
            return $js;
        }
        try {
            Categories::where('id', $id)->delete();
//            将删除的目录下的文章移动到根目录下。
            Article::where('category_id', $id)->update(['category_id' => config('blog.number.root')]);
            Categories::where('id', config('blog.number.root'))->update(['count' =>
                Article::where('category_id', 1)->where('state', config('blog.number.publish'))->count()]);
            $data = ['code' => config('error.code.success'), 'info' => '删除成功'];
        } catch (Exception $e) {
            $data = ['code' => config('error.code.cate.delete_fail'), 'info' => '删除失败'];
            echo $e;
        }
        $js = '<script>window.parent.promptDeleteResult('.json_encode($data).')</script>';
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
            if ($id == 1) {
                continue;
            }
//            将删除的目录下的文章移动到根目录下。
//            $oldCount = Categories::where('id', 1)->first()['count'];
//            $count = Categories::where('id', $id)->first()['count'];
//            $count += $oldCount;
//            Categories::where('id', 1)->update(['count' => $count]);
            Categories::where('id', $id)->delete();
            Categories::where('id', 1)->update(['count' =>
                Article::where('category_id', 1)->where('state', config('blog.number.publish'))->count()]);
            Article::where('category_id', $id)->update(['category_id' => 1]);
            $index ++;
        }

        if ($index == $length) {
            $data = ['code' => config('error.code.success'), 'info' => '所选目录删除成功'];
        } else {
            $data = ['code' => config('error.code.success'), 'info' => '成功删除'.$index.'个目录,有'.($length-$index).'没有删除'];
        }

        return json_encode($data);
    }
}
