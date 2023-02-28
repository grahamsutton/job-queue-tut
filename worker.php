<?php

require_once __DIR__ . '/vendor/autoload.php';

use JobQueueTut\Jobs\SayHelloJob;

$redis = new Redis();
$redis->connect('redis', 6379);

echo 'Queue worker is listening for jobs...' . PHP_EOL;

while (true) {

    // Loop stops and waits here until a job becomes available
    $jobData = json_decode($redis->brpop('jobs', 0)[1], true);

    $jobBody = $jobData['body'];
    $jobType = $jobData['type'];

    // Here we can add new jobs based on their job `type`
    $job = match ($jobType) {
        'say_hello' => new SayHelloJob(),
        default => throw new \Exception("Job [{$jobType}] does not exist.")
    };

    $job->execute($jobBody);
}