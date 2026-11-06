<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use CaptureKit\Client;

$client = new Client(); // reads CAPTUREKIT_API_KEY
$response = $client->content(['url' => 'https://example.com']);
echo json_encode($response->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
