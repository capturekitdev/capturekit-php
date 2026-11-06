# CaptureKit PHP SDK

The official PHP SDK for the [CaptureKit](https://www.capturekit.dev) screenshot API.

Capture websites as PNG, JPEG, WebP or PDF, extract their content, or analyse them with AI.

The SDK exposes **7 methods**, one per documented endpoint (with array-shape PHPDoc for static analysis), plus a generic `request()`. It sends requests through any PSR-18 client and uses Guzzle by default.

## Requirements

- PHP 8.1 or newer

## Installation

```sh
composer require capturekitdev/sdk
```

## Get your API key

[Sign up for CaptureKit](https://app.capturekit.dev/register) or sign in, then copy your API key from the [dashboard](https://app.capturekit.dev). The client reads the `CAPTUREKIT_API_KEY` environment variable when no key is passed.

## Quick start

```php
<?php

require 'vendor/autoload.php';

use CaptureKit\Client;

$client = new Client(getenv('CAPTUREKIT_API_KEY') ?: null);
$response = $client->content(['url' => 'https://example.com']);
print_r($response->data);
```

Parameter arrays use the names of the [API reference](https://app.capturekit.dev/openapi). Unknown names throw a `SerializationException`; use `request()` for undocumented parameters.

## Binary responses

Endpoints that can return a file (image, PDF…) return a `JsonResponse` or a `BinaryResponse`:

```php
use CaptureKit\BinaryResponse;

$response = $client->capture(['url' => 'https://example.com', 'format' => 'png']);
if ($response instanceof BinaryResponse) {
    $response->save('screenshot.png');
}
```

## Async jobs

Any call accepts `is_async: true` (useful past the 60-second server limit): the response is then a `job_id`. `waitForJob()` polls `GET /v1/jobs/{id}` until a terminal status (`CompletedJob`, `Error`, `NotFound`, `BadRequest`):

```php
$submitted = $client->content(['url' => 'https://example.com', 'is_async' => true]);
$job = $client->waitForJob($submitted->data['job_id'], onProgress: static function (array $job): void {
    echo $job['status'], ' ', $job['progress'] ?? 0, "%\n";
});
print_r($job->data);
```

## GET or POST

Methods use GET when the endpoint supports it (query string). POST sends the same parameters as JSON:

```php
use CaptureKit\RequestOptions;

$client->analyze(['url' => 'test'], new RequestOptions(method: 'POST'));
```

`null` values are omitted, `false` and `0` are sent, and lists repeat the parameter name.

## Any endpoint

```php
$response = $client->request('GET', '/v1/usage');
```

## Errors

```php
use CaptureKit\Exception\ApiException;

try {
    $client->content(['url' => 'https://example.com']);
} catch (ApiException $exception) {
    echo $exception->status, ': ', $exception->getMessage();
}
```

| Exception | When |
| --- | --- |
| `ConfigurationException` | Missing API key, invalid options or unsupported method. |
| `SerializationException` | A required parameter is missing, unknown or can't be sent. |
| `TransportException` | Network failure or timeout. |
| `ApiException` | Non-2xx status (`status`, `errorMessage`, `responseBody`, `rawResponse`). |
| `ResponseDecodingException` | A success response could not be decoded. |

All of them extend `CaptureKit\Exception\CaptureKitException`.

## Retries

Requests are retried up to 3 times after a network error, a `408`, `500`, `502`, `503` or `504`, or a rate limit — which the API returns as `401` (or `429`) with a `Rate limit exceeded` message. Per-key quota errors (`…: quota daily`) are not retried, nor are `400`, `402`, `404` or client-side timeouts. The delay starts at 1 second and grows 1.5× per retry (capped at 30 seconds); a `Retry-After` header wins.

```php
$client = new Client(null, ['max_retries' => 5, 'retry_delay' => 0.5]);
$client->content(['url' => 'https://example.com'], new RequestOptions(maxRetries: 0)); // one request without retries
```

## Batch requests

`batch()` sends several calls with at most 10 requests in flight (`$concurrency`), through Guzzle's connection pool, and returns one `BatchResult` per call in input order. A failing call never stops the others. With a custom PSR-18 client the calls run one after another.

```php
$inputs = ['https://example.com', 'https://www.capturekit.dev', 'https://github.com'];
$calls = array_map(static fn(string $value): array => ['content', ['url' => $value]], $inputs);

foreach ($client->batch($calls, concurrency: 5) as $result) {
    if ($result->ok()) {
        print_r($result->value->data);
    } else {
        echo $inputs[$result->index], ': ', $result->error->getMessage(), "\n";
    }
}
```

| Constant | Default | Description |
| --- | --- | --- |
| `Client::DEFAULT_CONCURRENCY` | `10` | Tasks run at the same time by batch |
| `Client::DEFAULT_TIMEOUT` | `120.0` | Request timeout (seconds) |
| `Client::MAX_RETRIES` | `3` | Retry attempts after a network error, a 408/5xx or a rate limit |
| `Client::RETRY_BACKOFF_FACTOR` | `1.5` | Exponential backoff multiplier |
| `Client::DEFAULT_RETRY_DELAY` | `1.0` | Delay before the first retry (seconds) |

## Options and custom HTTP clients

```php
$client = new Client(null, [
    'timeout' => 60.0,               // seconds, default 120 (default Guzzle client only)
    'headers' => ['X-Trace' => 'abc'],
    'http_client' => $psr18Client,   // optional: any PSR-18 client
]);
```

## Endpoints

7 methods, generated from the [OpenAPI document](https://app.capturekit.dev/openapi).

| Method | HTTP | Description |
| --- | --- | --- |
| `analyze()` | GET / POST `/v1/analyze` | AI Content API analyzes any webpage and returns AI insights summary, value proposition, features, categories, use cases, and optional conta… |
| `capture()` | GET / POST `/v1/capture` | Browser-like Screenshot API that captures webpages as PNG/JPEG/WebP or PDF for previews, QA, reporting, monitoring, and archiving no headle… |
| `content()` | GET / POST `/v1/content` | CaptureKit Content API extracts structured webpage data, metadata, links, HTML/Markdown: in one request for SEO, monitoring, indexing and a… |
| `jobs()` | GET `/v1/jobs/{id}` | Poll the status, progress (0–100) and result of a job started with is_async=true. Polling is free. Poll until status is terminal: Completed… |
| `stats()` | GET `/v1/stats` | Infrastructure health for an engine or endpoint over the last hour. Not scoped to your account or tenant. Enabled per account: HTTP 403 mea… |
| `usage()` | GET `/v1/usage` | Retrieve real-time usage statistics and credit balance for your CaptureKit account. |
| `websiteCrawler()` | GET / POST `/v1/website/crawler` | Website Crawler API fetches raw HTML from any webpage in request mode (no rendering) for fast scraping, audits, monitoring, and link/metada… |

## All CaptureKit SDKs

| SDK | Package | Install |
| --- | --- | --- |
| Node.js | [`@capturekitdev/sdk`](https://www.npmjs.com/package/@capturekitdev/sdk) | `npm install @capturekitdev/sdk` |
| Python | [`capturekitdev`](https://pypi.org/project/capturekitdev/) | `pip install capturekitdev` |
| Go | [`capturekit-go`](https://pkg.go.dev/github.com/capturekitdev/capturekit-go) | `go get github.com/capturekitdev/capturekit-go` |
| .NET | [`CaptureKit`](https://www.nuget.org/packages/CaptureKit) | `dotnet add package CaptureKit` |
| Ruby | [`capturekitdev`](https://rubygems.org/gems/capturekitdev) | `gem install capturekitdev` |
| PHP | [`capturekitdev/sdk`](https://packagist.org/packages/capturekitdev/sdk) | `composer require capturekitdev/sdk` |
| Java | [`capturekit-java`](https://github.com/capturekitdev/capturekit-java) | build from source, see its README |
| CLI | [`@capturekitdev/cli`](https://www.npmjs.com/package/@capturekitdev/cli) | `npm install -g @capturekitdev/cli` |
| MCP server | [`@capturekitdev/mcp`](https://www.npmjs.com/package/@capturekitdev/mcp) | `npx -y @capturekitdev/mcp` |

## License

MIT — see [LICENSE](LICENSE).
