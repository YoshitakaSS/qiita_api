<?php
namespace App\Services;

use App\Repositories\V1\Interfaces\JobInterface;

class JobService
{
    private $jobRepository;
    private $jobName;

    public function __construct(JobInterface $jobRepository, $jobName)
    {
        $this->jobRepository = $jobRepository;
        $this->jobName = $jobName;
    }

    /**
     * ジョブを取得する
     *
     * @return array
     */
    public function getJobData()
    {
        // jobの確認を行う
        return $this->jobRepository->getJobData($this->jobName);
    }

    /**
     * jobを止める
     * @param int
     */
    public function stopJob(int $isLastSucceeded)
    {
        return $this->jobRepository->updateJobStatus($this->jobName, 100, false, $isLastSucceeded);
    }

    /**
     * jobを実行する
     */
    public function runJob()
    {
       return $this->jobRepository->updateJobStatus($this->jobName, 200, true);
    }
}
