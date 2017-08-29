<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 40; $i ++) {
            DB::table('articles')->insert([
                'user_id' => 1,
                'category_id' => random_int(1,10),
                'title' => str_random(random_int(5,20)),
                'description' => str_random(random_int(20, 40)),
                'markdown_content' => str_random(random_int(50, 200)),
                'html_content' => str_random(random_int(50, 200)),
                'state' => random_int(0, 2),
                'click_count' => random_int(1, 100),
            ]);
        }
    }
}
