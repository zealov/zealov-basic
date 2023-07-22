<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship', function (Blueprint $table) {
            $table->string('subject_type', 50)->comment('关联模型')->nullable();
            $table->integer('subject_id')->comment('关联模型ID')->nullable();
            $table->string('relationship_type')->comment('被关联模型')->nullable();
            $table->integer('relationship_id')->comment('被关联模型ID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationship');
    }
}
