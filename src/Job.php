<?php

namespace JobQueueTut;

interface Job
{
    public function execute(array $payload): void;
}
