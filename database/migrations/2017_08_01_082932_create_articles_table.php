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
            $table->increments('id')->comment("文章主键");
            $table->integer('user_id')->unsigned()->commend("文章作者id")->index();
            $table->integer('category_id')->unsined()->default(0)->commend("文章分类")->index();
            $table->string('title')->unique()->comment("文章标题");
            $table->string('description')->default('')->comment('描述');
            $table->text('markdown_content')->comment("markdown格式文章内容");
            $table->text('html_content')->comment("HTML格式文章内容");
            $table->integer('click_count')->unsigned()->default(0)->comment("文章点击次数");

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
