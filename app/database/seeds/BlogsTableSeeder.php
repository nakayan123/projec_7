<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('blogs')->insert([
        [
        'user_id' => 1,
        'date' => '2021-12-01',
        'venue' => '航空公園',
        'text' => 'サンプル1',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
        [
        'user_id' => 1,
        'date' => '2021-12-02',
        'venue' => '航空公園',
        'text' => 'サンプル2',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
        [
        'user_id' => 1,
        'date' => '2021-12-03',
        'venue' => '航空公園',
        'text' => 'サンプル3',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
    ]);
    }
}
