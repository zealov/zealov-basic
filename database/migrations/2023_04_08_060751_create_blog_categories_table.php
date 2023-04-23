<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('名称')->nullable();
            $table->string('label', 100)->comment('标识')->nullable();
            $table->integer('parent_id')->comment('上级导航')->default(0)->nullable();
            $table->text('description')->comment('路径')->nullable();
            $table->string('image_path', 300)->comment('图片地址')->nullable();
            $table->tinyInteger('published')->comment('是否发布 1发布 2未发布')->default(1)->nullable();
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
        Schema::dropIfExists('blog_categories');
    }
}