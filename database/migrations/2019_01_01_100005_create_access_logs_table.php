<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id',11)->comment('文章id');
            $table->string('ip',100)->comment('访问ip地址');
            $table->string('country',50)->comment('国家');
            $table->string('city',50)->comment('城市');
            $table->timestamp('created_at')->comment('访问时间');
            $table->engine = 'MyISAM';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `access_logs` comment'访问记录表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_logs');
    }
}
