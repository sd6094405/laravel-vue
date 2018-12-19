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
            $table->string('name',20)->comment('昵称');
            $table->tinyInteger('is_admin')->default(0)->comment('是否管理员');
            $table->string('email',30)->unique()->comment('邮箱账号');
            $table->string('password')->comment('密码');
//            $table->string('')->comment('密码');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` comment'用户表'"); // 表注释
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
