<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
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
            DB::table("links")->insert([
//                'id' => $i,
                'name' => str_random(random_int(3,8)),
                'url' => 'http://www' . str_random(10) . 'com',
                'weight' => random_int(1, 100),
            ]);
        }
    }
}
