<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'hhb',
            'is_admin' => 1,
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
        ]);
        \Illuminate\Support\Facades\DB::table('systems')->insert([
            [
                'key' => 'seo',
                'value' => 'laravel_blog',
                'desc'=>'SEO信息'
            ],
            [
                'key' => 'desc',
                'value' => 'Laravel-Blog是一个后端基于Laravel框架和前段Vue框架实现的一个博客项目',
                'desc'=>'页面描述信息'

            ],
            [
                'key' => 'filing',
                'value' => 123456789,
                'desc'=>'备案号'

            ],
            [
                'key' => 'signature',
                'value' => '做一只会翻身的咸鱼 😍',
                'desc'=>'页面签名'

            ]]
        );
    }
}
