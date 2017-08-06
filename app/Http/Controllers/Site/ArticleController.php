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


    //admin
    // 文章列表
    public function articleList() {
        return 'list';
    }

    // 创建
    public function create() {
        return 'create';
    }

    // 创建后保存
    public function store(Request $request) {
        return 'store';
    }

    // 编辑
    public function edit($id) {
        return 'edit';
    }

    // 编辑后更新
    public function save() {
        return 'save';
    }

    // 删除
    public function destroy($id) {
        return 'destroy';
    }
}
