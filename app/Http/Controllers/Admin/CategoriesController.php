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
        Categories::insert(['name' => trim($name)]);
        try {
            Categories::insert(['name' => trim($name)]);
            $data = ['state' => 0, 'info' => '添加成功'];
        } catch(Exception $e) {
            $data = ['state' => 1, 'info' => '更新失败'];
        }
        $js = "<script>parent.promptAddResult(".json_encode($data).")</script>";
        return $js;
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
        $name = $request['name'];
        try {
            Categories::where('id', $id)->update(['name' => $name]);
            $data = ['state' => 0, 'info' => '更新成功'];
        } catch(Exception $e) {
            $data = ['state' => 1, 'info' => '更新失败'];
        }
        $js = "<script>parent.promptChangeResult(".json_encode($data).")</script>";
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
            $data = ['state' => config('error.cate.cannot_delete_root'), 'info' => '不能删除根目录'];
            $js = "<script>parent.promptDeleteResult(".json_encode($data).")</script>";
            return $js;
        }
        try {
            Categories::where('id', $id)->delete();
            $data = ['state' => config('error.success'), 'info' => '删除成功'];
        } catch (Exception $e) {
            $data = ['state' => config('error.delete_fail'), 'info' => '删除失败'];
            echo $e;
        }
        $js = "<script>parent.promptDeleteResult(".json_encode($data).")</script>";
        return $js;
    }
}
