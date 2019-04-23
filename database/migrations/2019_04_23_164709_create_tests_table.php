<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->default(0)->comment('所属科目');
            $table->integer('user_id')->default(0)->comment('所属用户');
            $table->unsignedInteger('score')->default(0)->comment('测试得分');
            $table->tinyInteger('status')->default(-1)->comment('状态 -2:暂停 -1:初始值 1:进行中 2完成');
            $table->unsignedInteger('remainder')->default(0)->comment('暂停后记录剩余时间(秒)');
            $table->timestamp('expires')->comment('到期时间（重新开始后，重新计算）');
            $table->timestamp('submitted_at')->comment('提交时间');
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
        Schema::dropIfExists('tests');
    }
}
