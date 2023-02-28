<?php

namespace JobQueueTut\Jobs;

use JobQueueTut\Job;

class SayHelloJob implements Job
{
    public function execute(array $payload): void
    {
        $name = $payload['name'];

        echo "{$name} says hello!" . PHP_EOL;
    }
}
