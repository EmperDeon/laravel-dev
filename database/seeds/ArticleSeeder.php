<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create(['user_id' => '1', 'name' => 'Article 1', 'desc_s' => trans('global.lorem'), 'desc' => trans('global.lorem-long'), 'img' => 'none.png']);
        Article::create(['user_id' => '1', 'name' => 'Article 2', 'desc_s' => trans('global.lorem'), 'desc' => trans('global.lorem-long'), 'img' => 'none.png']);
        Article::create(['user_id' => '2', 'name' => 'Article 3', 'desc_s' => trans('global.lorem'), 'desc' => trans('global.lorem-long'), 'img' => 'none.png']);
        Article::create(['user_id' => '3', 'name' => 'Article 4', 'desc_s' => trans('global.lorem'), 'desc' => trans('global.lorem-long'), 'img' => 'none.png']);
        Article::create(['user_id' => '4', 'name' => 'Article 5', 'desc_s' => trans('global.lorem'), 'desc' => trans('global.lorem-long'), 'img' => 'none.png']);
    }
}
