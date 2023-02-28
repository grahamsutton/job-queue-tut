<?php

// Add multiple jobs if argument provided, only 1 if not provided
$totalRecords = $argv[1] ?? 1;

$redis = new \Redis();
$redis->connect('redis', 6379);

$randomPeople = [
    'John', 'Jane', 'Mike', 'Miguel', 'Jacob', 'Karen',
    'Chris', 'David', 'Angela', 'Garrett', 'William'
];

$startTime = microtime(true);

// Insert jobs to Redis queue
for ($i = 0; $i < $totalRecords; $i++) {
    $randomPerson = $randomPeople[array_rand($randomPeople, 1)];

    $redis->lpush('jobs', json_encode([
        'type' => 'say_hello',
        'body' => [
            'name' => $randomPerson
        ]
    ]));
}

$totalTimeMs = (microtime(true) - $startTime) * 1000;

echo "{$totalRecords} job(s) added in {$totalTimeMs} ms.";
echo PHP_EOL;

