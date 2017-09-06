<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
//            $table->engine = 'MyISAM';
            $table->increments('id')->comment("文章主键");
            $table->integer('user_id')->unsigned()->commend("文章作者id")->index();
            $table->integer('category_id')->default(1)->commend("文章分类id")->index();
            $table->string('title')->comment("文章标题");
            $table->string('description')->default('')->comment('描述');
//            $table->string('filename')->null(false)->comment('文章保存文件名称');
//            $table->string('filepath')->default('./')->comment("文章保存相对路径");
            $table->text('markdown')->comment("文章markdown内容");
            $table->text('html')->comment("文章HTML内容");
            $table->integer('state')->default(1)->comment("文章状态，0为已发布，1为草稿，2为垃圾箱")->index();
            $table->integer('click_count')->default(0)->comment("文章点击次数");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
