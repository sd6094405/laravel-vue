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
            'seo'=>'hhb-blog,laravel-blog,laravel-vue-blog',
            'desc'=>'Laravel-Blog是一个后端基于Laravel框架和前段Vue框架实现的一个博客项目',
            'filing'=>'123456789',
            'signature'=>'做一只会翻身的咸鱼。 😍'
        ]);
    }
}
