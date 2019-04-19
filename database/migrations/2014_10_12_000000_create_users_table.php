<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->comment('用户名');
            $table->string('openid')->unique()->comment('用户唯一标识');
            $table->string('phone')->default('')->comment('手机号');
            $table->string('email')->default('')->comment('电子邮箱');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('country')->default('')->comment('国家');
            $table->string('province')->default('')->comment('省份');
            $table->string('city')->default('')->comment('城市');
            $table->string('language')->default('')->comment('语言');
            $table->tinyInteger('gender')->default(0)->comment('性别 0:未知 1:男 2:女');
            $table->string('union_id')->default('')->comment('UNIONID');
            $table->string('password')->comment('密码');
            $table->unsignedInteger('point')->default(0)->comment('积分');
            $table->tinyInteger('status')->default(-1)->comment('状态 -1:禁用 1:启用');
            $table->timestamp('expires')->comment('用户信息刷新标识（防止用户修改信息后没有及时更新）');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
