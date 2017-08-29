<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < random_int(30, 50); $i++) {
            DB::table('article_tags')->insert([
                'article_id' => random_int(1, 40),
                'tag_id' => random_int(1, 10),
            ]);
        }
    }
}
