<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //插入根目录
        DB::table('categories')->insert([
//            'id' => 1,
            'name' => '根目录',
            'count' => random_int(1, 20),
        ]);
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
//                'id' => $i,
                'name' => str_random(5),
                'count' => random_int(1, 20),
            ]);
        }

    }
}
