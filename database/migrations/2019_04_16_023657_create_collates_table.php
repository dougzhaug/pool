<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('提交者');
            $table->integer('pool_id')->default(0)->comment('所属题目');
            $table->text('answers')->comment('校对后的答案');
            $table->tinyInteger('status')->default(-1)->comment('状态 -2:未采纳 -1:未处理 1:采纳');
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
        Schema::dropIfExists('collates');
    }
}
