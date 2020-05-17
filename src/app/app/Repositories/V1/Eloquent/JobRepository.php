<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Eloquent\Models\Job;
use App\Repositories\V1\Interfaces\JobInterface;

class JobRepository implements JobInterface
{
    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function getJobData($jobName)
    {
        return $this->job
                    ->where('job_name', $jobName)
                    ->first();

    }

    /**
     * jobを保存する
     * job_status: default 100（未実行
     *                     200（実行中
     *                     300（エラー
     *
     * @param string
     * @param string
     */
    public function storeJobData($jobName, $jobDescription)
    {
        return $this->job
                    ->insert([
                        'job_name'          => $jobName,
                        'job_description'   => $jobDescription,
                        'job_status'        => 100,
                        'created_at'        => now(),
                    ]);
    }

    /**
     * @param string
     * @param int
     * @param bool
     * @param int 0:正常終了, 1:エラー終了
     */
    public function updateJobStatus($jobName, $status, $isRun, $isLastSucceeded = 0)
    {
        $updateList = [
            'job_status'        => $status,
            'is_last_succeeded' => $isLastSucceeded
        ];

        $dateTime = date('Y-m-d H:m:s');
        $jobDate = $isRun ? ['job_last_start_time' => $dateTime] : ['job_last_end_time' => $dateTime];

        $updateList = array_merge($updateList, $jobDate);

        return $this->job
                    ->where('job_name', $jobName)
                    ->update($updateList);
    }
}
