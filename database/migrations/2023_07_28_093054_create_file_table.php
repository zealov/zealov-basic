<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->comment('名称')->nullable();
            $table->text('description')->comment('描述')->nullable();
            $table->text('redirect')->comment('跳转地址')->nullable();
            $table->text('path')->comment('文件路径')->nullable();
            $table->integer('sort')->comment('排序')->default(1)->nullable();
            $table->integer('size')->comment('文件大小')->default(1)->nullable();
            $table->integer('published')->comment('发布')->default(1)->nullable();
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
        Schema::dropIfExists('file');
    }
}
