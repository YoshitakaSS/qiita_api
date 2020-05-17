<?php

namespace App\Repositories\V1\Interfaces;

interface JobInterface
{
    /**
     * @param string
     */
    public function getJobData($jobName);

    /**
     * @param string
     * @param string
     */
    public function storeJobData($jobName, $jobDescription);

    /**
     * @param string
     * @param int
     * @param bool
     * @param int 0:正常終了, 1:エラー終了
     */
    public function updateJobStatus($jobName, $status, $isRun, $isLastSucceeded = 0);
}
