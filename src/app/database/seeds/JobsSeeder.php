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
        // データのクリア
        DB::table('authors')->truncate();

        $paramList = [
            [
                'job_name'                  => 'insert_author_job',
                'job_description'           => 'Qiitaのトレンド入りした著者を格納する',
                'job_status'                => 100,
                'is_last_succeeded'         => 0,
                'job_last_start_time'       => now(),
                'job_last_end_time'         => now(),
                'created_at'                => '2000-01-01 00:00:00',
                'updated_at'                => '2000-01-01 00:00:00'
            ],
            [
                'job_name'                  => 'insert_tags_job',
                'job_description'           => 'Qiitaのトレンド入りしたタグを格納する',
                'job_status'                => 100,
                'is_last_succeeded'         => 0,
                'job_last_start_time'       => now(),
                'job_last_end_time'         => now(),
                'created_at'                => '2000-01-01 00:00:00',
                'updated_at'                => '2000-01-01 00:00:00'
            ]
        ];


        foreach ($paramList as $param) {
            DB::table('jobs')->insert($param);
        }
    }
}
