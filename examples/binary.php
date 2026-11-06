<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use CaptureKit\Client;

$client = new Client(); // reads CAPTUREKIT_API_KEY
$response = $client->capture(['url' => 'https://example.com', 'format' => 'png']);
if ($response instanceof CaptureKit\BinaryResponse) {
    $response->save('screenshot.png');
    echo 'Saved screenshot.png (', $response->contentType, ', ', \strlen($response->bytes), " bytes)\n";
} else {
    print_r($response->data);
}
