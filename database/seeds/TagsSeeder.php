<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i < 10; $i++) {
            DB::table("tags")->insert([
//                'id' => $i,
                'name' => str_random(random_int(3,8)),
            ]);
        }

    }
}
