<?php

namespace App\Repositories\V1\Interfaces;

interface JobInterface
{
    public function getJobData($jobName);

    public function storeJobData($jobName, $jobDescription);

    public function updateJobStatus($jobName, $status, $isRun);
}
