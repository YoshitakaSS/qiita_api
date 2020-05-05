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
                'author_name' => 'AAAAAAA',
                'count' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            1 => [
                'author_name' => 'BBBBBBB',
                'count' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            2 => [
                'author_name' => 'CCCCCCC',
                'count' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($paramList as $param) {
            DB::table('authors')->insert($param);
        }
    }
}
