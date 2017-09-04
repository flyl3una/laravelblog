<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        //调用函数
    function rand_time($start_time,$end_time){
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        return date('Y-m-d H:i:s', mt_rand($start_time,$end_time));
    }


    public function run()
    {
        //
        $start_time = '2015-01-01 00:00:00';
        $end_time = '2017-09-01 00:00:00';
        for ($i = 0; $i < 40; $i ++) {
            DB::table('articles')->insert([
                'user_id' => 1,
                'category_id' => random_int(1,10),
                'title' => str_random(random_int(5,20)),
                'description' => str_random(random_int(20, 40)),
//                'filename' => str_random('1.md'),
                'markdown' => str_random(random_int(100, 500)),
                'html' => str_random(random_int(100, 500)),
//                'filepath' => Storage::disk('posts'),
//                'markdown_content' => str_random(random_int(50, 200)),
//                'html_content' => str_random(random_int(50, 200)),
                'state' => random_int(0, 2),
                'click_count' => random_int(1, 100),
                'created_at' => $this->rand_time($start_time, $end_time),
                'updated_at' => $this->rand_time($start_time, $end_time),
//                'created_at' =>  strval(random_int(2000, 2017)).'-'.strval(random_int(1, 12)).'-'.strval(random_int(1,30)).' '
//                .strval(random_int(1,12)).strval(random_int(1,12)).':00',
//
//                'updated_at' =>  strval(random_int(2000, 2017)).'-'.strval(random_int(1, 12)).'-'.strval(random_int(1,30)).' '
//                    .strval(random_int(1,12)).strval(random_int(1,12)).':00',
//                'create_at' =>
            ]);
        }
    }
}
