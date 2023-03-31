<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('账户')->nullable();
            $table->string('nick_name', 100)->comment('昵称')->nullable();
            $table->string('password', 200)->comment('密码')->nullable();
            $table->string('email', 50)->comment('邮箱')->nullable();
            $table->string('salt', 16)->comment('盐值')->nullable();
            $table->tinyInteger('status')->comment('1启用 2禁用')->default('1');
            $table->unique('name');
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
        Schema::dropIfExists('admins');
    }
}
