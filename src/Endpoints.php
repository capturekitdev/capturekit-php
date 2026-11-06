<?php

declare(strict_types=1);

namespace CaptureKit;

// Generated from the CaptureKit OpenAPI document. Do not edit by hand.

/**
 * Path, methods, response kind and parameter names of every documented operation.
 */
final class Endpoints
{
    /**
     * @var array<string, array{path: string, methods: list<'GET'|'POST'>, response: 'json'|'any', required: list<string>, params: list<string>}>
     */
    public const ALL = [
        'analyze' => [
            'path' => '/v1/analyze',
            'methods' => ['GET', 'POST'],
            'response' => 'json',
            'required' => ['url'],
            'params' => ['url', 'custom_response', 'custom_prompt', 'proxy', 'cache', 'cache_ttl', 'fields', 'is_async', 'soft_fail'],
        ],
        'capture' => [
            'path' => '/v1/capture',
            'methods' => ['GET', 'POST'],
            'response' => 'any',
            'required' => ['url'],
            'params' => ['url', 'format', 'device', 'full_page', 'full_page_scroll', 'full_page_scroll_duration', 'viewport_width', 'viewport_height', 'scale_factor', 'image_quality', 'selector', 'cache', 'cache_ttl', 'remove_selectors', 'remove_cookie_banners', 'remove_ads', 'block_resources', 'block_urls', 'delay', 'wait_until', 'wait_for_selector', 'proxy', 's3_secret_key', 's3_access_key_id', 's3_bucket', 's3_object_key', 's3_region', 'storage_endpoint', 's3_url', 'fields', 'is_async', 'soft_fail'],
        ],
        'content' => [
            'path' => '/v1/content',
            'methods' => ['GET', 'POST'],
            'response' => 'json',
            'required' => ['url'],
            'params' => ['url', 'include_html', 'include_markdown', 'include_sitemap', 'use_defuddle', 'remove_selectors', 'remove_cookie_banners', 'remove_ads', 'block_resources', 'block_urls', 'delay', 'wait_until', 'wait_for_selector', 'proxy', 'cache', 'cache_ttl', 'fields', 'is_async', 'soft_fail'],
        ],
        'jobs' => [
            'path' => '/v1/jobs/{id}',
            'methods' => ['GET'],
            'response' => 'json',
            'required' => ['id'],
            'params' => ['id'],
        ],
        'stats' => [
            'path' => '/v1/stats',
            'methods' => ['GET'],
            'response' => 'json',
            'required' => [],
            'params' => ['engine', 'path'],
        ],
        'usage' => [
            'path' => '/v1/usage',
            'methods' => ['GET'],
            'response' => 'json',
            'required' => [],
            'params' => [],
        ],
        'website_crawler' => [
            'path' => '/v1/website/crawler',
            'methods' => ['GET', 'POST'],
            'response' => 'any',
            'required' => ['query'],
            'params' => ['query', 'allow_redirects', 'return_page_source', 'fields', 'is_async', 'soft_fail'],
        ],
    ];

    /**
     * SDK method name to endpoint name, for batch().
     *
     * @var array<string, string>
     */
    public const METHODS = [
        'analyze' => 'analyze',
        'capture' => 'capture',
        'content' => 'content',
        'jobs' => 'jobs',
        'stats' => 'stats',
        'usage' => 'usage',
        'websiteCrawler' => 'website_crawler',
    ];
}
