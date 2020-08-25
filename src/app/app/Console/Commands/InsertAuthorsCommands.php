<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Repositories\V1\Interfaces\AuthorInterface;
use App\Repositories\V1\Interfaces\JobInterface;
use App\Services\JobService;
use Exception;

class InsertAuthorsCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertAuthors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert authors json To Authors Table';

    protected $authorRepository;
    protected $jobService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuthorInterface $authorRepository, JobInterface $jobRepository)
    {
        parent::__construct();
        $this->authorRepository = $authorRepository;
        $this->jobService = new JobService($jobRepository, 'insert_author_job');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('process: start');
        $starttime = microtime(true);

        $today = date('Y-m-d');

        try {
            $filePath = in_array(env('APP_ENV'), ['local', 'dev', 'testing'], true)
                        ? __DIR__ . '/../../../tests/Unit/Resources/AuthorUnitResource.json' : "/mnt/json/author/$today.json";

            $jobData = $this->jobService->getJobData();

            if (empty($jobData)) {
                throw new Exception('job process is not defined');
            }
            // 実行中だったらthrow
            if ($jobData->job_status == 200) {
                throw new Exception('job prorocess is already running');
            }
            // 今日すでに実行済みであり、正常終了であれば実行しない
            if ($jobData->is_last_succeeded == 0 && $jobData->job_last_start_time >= "$today 00:00:00") {
                throw new Exception('todays process is already done');
            }

            // jobを実行する
            $this->jobService->runJob();

            // 教諭フォルダにあるJSONを取得する
            $authorJson = file_get_contents($filePath);
            $authosList = json_decode($authorJson, true);

            foreach ($authosList as $author) {
                // 既にデータがあるのか確認する
                $res = $this->authorRepository->getAuthorByName($author);

                if (is_null($res)) {
                    $this->authorRepository->storeAuthors($author);
                } else {
                    $this->authorRepository->updateAuthors($author, $res->count);
                }
            }
        } catch (Exception $e) {
            $this->info(sprintf('process: %s errorinfo: %s', 'error', $e));
            $this->jobService->stopJob(1);
        } finally {
            $this->jobService->stopJob(0);
            $endtime = microtime(true) - $starttime;
            $this->info(sprintf('process: %s, processTime: %s', 'end', $endtime));
        }
    }
}
