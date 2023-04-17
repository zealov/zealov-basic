<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->comment('文章名称')->nullable();
            $table->string('sub_name', 300)->comment('副标题')->nullable();
            $table->string('author', 100)->comment('作者')->nullable();
            $table->string('from', 100)->comment('来源')->nullable();
            $table->integer('view')->comment('查看次数')->default(1)->nullable();
            $table->string('thumbnail',200)->comment('缩略图')->nullable();
            $table->text('description')->comment('简介')->nullable();
            $table->longtext('content')->comment('内容')->nullable();
            $table->string('image_path', 300)->comment('图片地址')->nullable();
            $table->string('redirect', 300)->comment('跳转地址')->nullable();
            $table->tinyInteger('published')->comment('是否发布 1发布 2未发布')->default(1)->nullable();
            $table->tinyInteger('pinned')->comment('置顶 1非置顶 2置顶')->default(1)->nullable();
            $table->integer('sort')->comment('排序')->default(1)->nullable();
            $table->dateTime('deleted_at')->comment('删除')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
}
