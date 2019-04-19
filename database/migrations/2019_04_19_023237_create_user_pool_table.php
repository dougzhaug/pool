<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pool', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pool_id');
            $table->tinyInteger('status')->default(-1)->comment('状态 -1:未背 1:已背');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('pool_id')
                ->references('id')
                ->on('pools')
                ->onDelete('cascade');

            $table->primary(['user_id', 'pool_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_pool');
    }
}
