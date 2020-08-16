<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        DB::table('authors')->truncate();

        $paramList = [
            0 => [
                'author_name' => 'qiita_user_1',
                'count' => 100,
                'created_at' => '2020-10-10 21:00:00',
                'updated_at' => '2020-10-10 22:00:00',
            ],
            1 => [
                'author_name' => 'qiita_user_2',
                'count' => 150,
                'created_at' => '2020-11-11 21:00:00',
                'updated_at' => '2020-12-10 22:00:00',
            ],
            2 => [
                'author_name' => 'qiita_user_3',
                'count' => 800,
                'created_at' => '2020-12-23 21:00:00',
                'updated_at' => '2020-12-25 22:30:00',
            ],
        ];

        foreach ($paramList as $param) {
            DB::table('authors')->insert($param);
        }
    }
}
