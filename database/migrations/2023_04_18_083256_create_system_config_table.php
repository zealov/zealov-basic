<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->comment('标题')->nullable();
            $table->string('key', 200)->comment('键')->nullable();
            $table->string('group', 200)->comment('分组')->nullable();
            $table->unique('key', 'system_config_key');
            $table->longtext('value', 100)->comment('值')->nullable();
            $table->string('type', 100)->comment('类型')->nullable();
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
        Schema::dropIfExists('system_config');
    }
}
