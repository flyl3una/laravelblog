<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $links = Link::paginate(config('blog.admin_per_number'));
        return view('admin.link.index', compact('links'));
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
        $name = trim($request['linkName']);
        $url = trim($request['linkUrl']);
//        Link::insert(['name' => $name, 'url' => $url]);
        $link = new Link();
        $link['name'] = $name;
        $link['url'] = $url;
        $link->save();
        return redirect(route('link.index'));
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
        $url = trim($request['url']);
//        Link::where('id', $id)->update(['name' => $name, 'url' => $url]);
        try {
            $link = Link::where('id', $id)->first();
            $link['name'] = $name;
            $link['url'] = $url;
            $link->update();
            $data = ['code' => 0, 'info' => '更新成功'];
        } catch (Exception $e) {
            $data = ['code' => config('error.code.cate.delete_fail'), 'info' => '删除失败'];
        }
        $js = "<script>window.parent.promptChangeResult(" . json_encode($data) . ")</script>";
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
        try {
            Link::where('id', $id)->delete();
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
            Link::where('id', $id)->delete();
            $index++;
        }
        if ($index == $length) {
            $data = ['code' => config('error.code.success'), 'info' => '所选链接删除成功'];
        } else {
            $data = ['code' => config('error.code.success'), 'info' => '成功删除' . $index . '个目录,有' . ($length - $index) . '没有删除'];
        }
        return json_encode($data);
    }
}
