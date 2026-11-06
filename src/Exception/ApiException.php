<?php

declare(strict_types=1);

namespace CaptureKit\Exception;

use CaptureKit\RawResponse;

/**
 * CaptureKit returned a non-success HTTP status.
 */
final class ApiException extends CaptureKitException
{
    public readonly int $status;

    public function __construct(
        public readonly RawResponse $rawResponse,
        public readonly mixed $responseBody = null,
        public readonly ?string $errorMessage = null,
    ) {
        $this->status = $rawResponse->status;
        parent::__construct($errorMessage ?? sprintf('CaptureKit API request failed with status %d.', $rawResponse->status), $rawResponse->status);
    }
}
