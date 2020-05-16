<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paramList = [
            [
                'insert_author_job',
                'Qiitaのトレンド入りした著者を格納する',
                100,
                '2000-01-01 00:00:00',
                '2000-01-01 00:00:00'
            ]
        ];


        foreach ($paramList as $param) {
            DB::table('jobs')->insert($param);
        }
    }
}
