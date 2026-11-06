<?php

declare(strict_types=1);

namespace CaptureKit;

// Generated from the CaptureKit OpenAPI document. Do not edit by hand.

/**
 * One method per documented CaptureKit endpoint. Used by {@see Client}.
 */
trait Operations
{
    /**
     * @param array<string, mixed> $params
     */
    abstract protected function callOperation(string $name, array $params, ?RequestOptions $options): JsonResponse|BinaryResponse;

    /**
     * Analyze (AI). AI Content API analyzes any webpage and returns AI insights summary, value proposition, features, categories, use cases, and optional contact signals. Credit cost: 1 credit per call.
     *
     * `GET / POST /v1/analyze`
     *
     * @param array{url: string, custom_response?: string, custom_prompt?: string, proxy?: string, cache?: bool, cache_ttl?: int|float, fields?: string, is_async?: bool, soft_fail?: bool} $params
     *   - url (required): The URL of the webpage to capture.
     *   - custom_response: Pass custom response fields to be included in the AI response.
     *   - custom_prompt: Add your own instructions to guide the AI’s analysis.
     *   - proxy: Specify a proxy server to route your request through.
     *   - cache: Cache the response.
     *   - cache_ttl: Cache the response for a custom TTL (in seconds).
     *   - fields: Comma-separated list of fields to keep in the response, with dot notation for nested fields (e.g. name,location.city). Does not change the credit cost.
     *   - is_async: Process the request asynchronously: the response is a job_id to poll on /v1/jobs/{id} (see waitForJob).
     *   - soft_fail: Return HTTP 200 even when an error occurs; the error is then in the response body.
     */
    public function analyze(array $params, ?RequestOptions $options = null): JsonResponse
    {
        $response = $this->callOperation('analyze', $params, $options);
        \assert($response instanceof JsonResponse);

        return $response;
    }

    /**
     * Capture (Screenshot). Browser-like Screenshot API that captures webpages as PNG/JPEG/WebP or PDF for previews, QA, reporting, monitoring, and archiving no headless setup. Credit cost: 1 credit per call.
     *
     * `GET / POST /v1/capture`
     *
     * @param array{url: string, format?: string, device?: string, full_page?: bool, full_page_scroll?: bool, full_page_scroll_duration?: int|float, viewport_width?: int|float, viewport_height?: int|float, scale_factor?: int|float, image_quality?: string, selector?: string, cache?: bool, cache_ttl?: int|float, remove_selectors?: string, remove_cookie_banners?: bool, remove_ads?: bool, block_resources?: string, block_urls?: string, delay?: int|float, wait_until?: list<string>, wait_for_selector?: string, proxy?: string, s3_secret_key?: string, s3_access_key_id?: string, s3_bucket?: string, s3_object_key?: string, s3_region?: string, storage_endpoint?: string, s3_url?: bool, fields?: string, is_async?: bool, soft_fail?: bool} $params
     *   - url (required): The URL of the webpage to capture. Examples:  https://www.amazon.com/s?k=pokemon
     *   - format: The output format of the screenshot.
     *   - device: The device type to emulate for the screenshot.
     *   - full_page: Capture the entire page instead of just the visible viewport.
     *   - full_page_scroll: Scroll the page to fully load lazy-loaded elements before capturing a full-page screenshot.
     *   - full_page_scroll_duration: Time in milliseconds for scrolling before capturing the full page.
     *   - viewport_width: The width of the browser viewport in pixels.
     *   - viewport_height: The height of the browser viewport in pixels.
     *   - scale_factor: The scale factor for high-resolution screenshots.
     *   - image_quality: Generate images with custom quality settings.
     *   - selector: Capture a specific element on the page instead of the full viewport.
     *   - cache: Cache the response.
     *   - cache_ttl: Cache the response for a custom TTL (in seconds).
     *   - remove_selectors: A comma-separated list of elements to hide before capturing (e.g., ads, popups).
     *   - remove_cookie_banners: Automatically remove cookie banners before capturing.
     *   - remove_ads: Automatically remove ads before capturing.
     *   - block_resources: Comma-separated list of resource types to block (e.g., “image,stylesheet,font”).
     *   - block_urls: Comma-separated list of URL patterns to block (e.g., “analytics,tracking,advertisement”).
     *   - delay: Delay in seconds before capturing the screenshot.
     *   - wait_until: Define when to capture.
     *   - wait_for_selector: Wait for a specific element to appear before taking the screenshot.
     *   - proxy: Specify a proxy server to route your request through.
     *   - s3_secret_key: AWS S3 secret access key.
     *   - s3_access_key_id: AWS S3 access key ID.
     *   - s3_bucket: The S3 bucket name where the screenshot will be uploaded.
     *   - s3_object_key: The filename for the S3 object (auto-generated if not provided).
     *   - s3_region: AWS S3 region for storage.
     *   - storage_endpoint: Leave this field empty for AWS S3. Only specify a value if required. S3-compatible storage services are supported, for example, use https://<accountId>.r2.clou…
     *   - s3_url: Use S3 storage for screenshots. The S3 URL will be returned in the response.
     *   - fields: Comma-separated list of fields to keep in the response, with dot notation for nested fields (e.g. name,location.city). Does not change the credit cost.
     *   - is_async: Process the request asynchronously: the response is a job_id to poll on /v1/jobs/{id} (see waitForJob).
     *   - soft_fail: Return HTTP 200 even when an error occurs; the error is then in the response body.
     */
    public function capture(array $params, ?RequestOptions $options = null): JsonResponse|BinaryResponse
    {
        return $this->callOperation('capture', $params, $options);
    }

    /**
     * Content. CaptureKit Content API extracts structured webpage data, metadata, links, HTML/Markdown: in one request for SEO, monitoring, indexing and automation. Credit cost: 1 credit per call.
     *
     * `GET / POST /v1/content`
     *
     * @param array{url: string, include_html?: bool, include_markdown?: bool, include_sitemap?: bool, use_defuddle?: bool, remove_selectors?: string, remove_cookie_banners?: bool, remove_ads?: bool, block_resources?: string, block_urls?: string, delay?: int|float, wait_until?: list<string>, wait_for_selector?: string, proxy?: string, cache?: bool, cache_ttl?: int|float, fields?: string, is_async?: bool, soft_fail?: bool} $params
     *   - url (required): The URL of the webpage to capture.
     *   - include_html: Include the raw HTML of the webpage in the response.
     *   - include_markdown: Include the Markdown of the webpage in the response.
     *   - include_sitemap: Include the sitemap of the website in the response.
     *   - use_defuddle: Use Defuddle to clean and extract the main content from web pages. This popular library removes unnecessary elements like comments, sidebars, headers, footers,…
     *   - remove_selectors: A comma-separated list of elements to hide before capturing (e.g., ads, popups).
     *   - remove_cookie_banners: Automatically remove cookie banners before capturing.
     *   - remove_ads: Automatically remove ads before capturing.
     *   - block_resources: Comma-separated list of resource types to block (e.g., “image,stylesheet,font”).
     *   - block_urls: Comma-separated list of URL patterns to block (e.g., “analytics,tracking,advertisement”).
     *   - delay: Delay in seconds before capturing the screenshot.
     *   - wait_until: Define when to capture.
     *   - wait_for_selector: Wait for a specific element to appear before taking the screenshot.
     *   - proxy: Specify a proxy server to route your request through.
     *   - cache: Cache the response.
     *   - cache_ttl: Cache the response for a custom TTL (in seconds).
     *   - fields: Comma-separated list of fields to keep in the response, with dot notation for nested fields (e.g. name,location.city). Does not change the credit cost.
     *   - is_async: Process the request asynchronously: the response is a job_id to poll on /v1/jobs/{id} (see waitForJob).
     *   - soft_fail: Return HTTP 200 even when an error occurs; the error is then in the response body.
     */
    public function content(array $params, ?RequestOptions $options = null): JsonResponse
    {
        $response = $this->callOperation('content', $params, $options);
        \assert($response instanceof JsonResponse);

        return $response;
    }

    /**
     * Jobs. Poll the status, progress (0–100) and result of a job started with is_async=true. Polling is free. Poll until status is terminal: CompletedJob, Error, NotFound or BadRequest.
     *
     * `GET /v1/jobs/{id}`
     *
     * @param array{id: string} $params
     *   - id (required): The job_id returned by an endpoint called with is_async=true.
     */
    public function jobs(array $params, ?RequestOptions $options = null): JsonResponse
    {
        $response = $this->callOperation('jobs', $params, $options);
        \assert($response instanceof JsonResponse);

        return $response;
    }

    /**
     * Stats. Infrastructure health for an engine or endpoint over the last hour. Not scoped to your account or tenant. Enabled per account: HTTP 403 means contact support to activate it.
     *
     * `GET /v1/stats`
     *
     * @param array{engine?: string, path?: string} $params
     *   - engine: API family to check, for example capture. Provide at least engine or path.
     *   - path: Specific endpoint to check, for example /v1/capture. If you also pass engine, use an endpoint from that API.
     */
    public function stats(array $params = [], ?RequestOptions $options = null): JsonResponse
    {
        $response = $this->callOperation('stats', $params, $options);
        \assert($response instanceof JsonResponse);

        return $response;
    }

    /**
     * Usage. Retrieve real-time usage statistics and credit balance for your CaptureKit account.
     *
     * `GET /v1/usage`
     *
     * @param array{} $params
     */
    public function usage(array $params = [], ?RequestOptions $options = null): JsonResponse
    {
        $response = $this->callOperation('usage', $params, $options);
        \assert($response instanceof JsonResponse);

        return $response;
    }

    /**
     * Website Crawler. Website Crawler API fetches raw HTML from any webpage in request mode (no rendering) for fast scraping, audits, monitoring, and link/metadata extraction. Credit cost: 1 credit per call.
     *
     * `GET / POST /v1/website/crawler`
     *
     * @param array{query: string, allow_redirects?: bool, return_page_source?: bool, fields?: string, is_async?: bool, soft_fail?: bool} $params
     *   - query (required): A website URL with either the http or https protocol.
     *   - allow_redirects: If set to false, do not follow redirects.
     *   - return_page_source: If set to true, the response will be the HTML source of the page.
     *   - fields: Comma-separated list of fields to keep in the response, with dot notation for nested fields (e.g. name,location.city). Does not change the credit cost.
     *   - is_async: Process the request asynchronously: the response is a job_id to poll on /v1/jobs/{id} (see waitForJob).
     *   - soft_fail: Return HTTP 200 even when an error occurs; the error is then in the response body.
     */
    public function websiteCrawler(array $params, ?RequestOptions $options = null): JsonResponse|BinaryResponse
    {
        return $this->callOperation('website_crawler', $params, $options);
    }
}
