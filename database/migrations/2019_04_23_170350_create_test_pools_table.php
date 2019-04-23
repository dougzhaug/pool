<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestPoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_pools', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('test_id')->default(0)->comment('所属测试');
            $table->unsignedInteger('pool_id')->default(0)->comment('所属题目');
            $table->unsignedInteger('score')->default(0)->comment('本题得分');
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
        Schema::dropIfExists('test_pools');
    }
}
