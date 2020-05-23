<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\V1\Interfaces\TagsInterface;
use App\Repositories\V1\Interfaces\JobInterface;
use App\Services\JobService;
use Exception;

class InsertTagsCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertTags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert tags json To Tags Table';

    protected $tagsRepository;
    protected $jobService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TagsInterface $tagsRepository, JobInterface $jobRepository)
    {
        parent::__construct();
        $this->tagsRepository = $tagsRepository;
        $this->jobService = $this->jobService = new JobService($jobRepository, 'insert_tags_job');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(sprintf('process: %s start', $this->signature));
        $starttime = microtime(true);

        $today = date('Y-m-d');
        try {
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
            $tagsJson = file_get_contents("/mnt/json/tag/$today.json");
            $tagList = json_decode($tagsJson, true);

            foreach ($tagList as $tag) {
                // 既にデータがあるのか確認する
                $res = $this->tagsRepository->getTagsByTagName($tag['tag_name']);

                if (is_null($res)) {
                    $this->tagsRepository->storeTags($tag);
                } else {
                    $this->tagsRepository->updateTagsCount($res->tag_name, $res->tag_count);
                }
            }
            $this->jobService->stopJob(0);
        } catch (Exception $e) {
            $this->info(sprintf('process: %s errorinfo: %s', 'error', $e));
            $this->jobService->stopJob(1);
        } finally {
            $endtime = microtime(true) - $starttime;
            $this->info(sprintf('process: %s, processTime: %s', 'end', $endtime));
        }
    }
}
