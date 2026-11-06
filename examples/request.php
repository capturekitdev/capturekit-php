<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use CaptureKit\Client;

$client = new Client(); // reads CAPTUREKIT_API_KEY
try {
    $response = $client->request('GET', '/v1/usage');
    if ($response instanceof CaptureKit\JsonResponse) {
        print_r($response->data);
    }
} catch (CaptureKit\Exception\ApiException $exception) {
    fwrite(STDERR, sprintf("HTTP %d: %s\n", $exception->status, $exception->getMessage()));
}
