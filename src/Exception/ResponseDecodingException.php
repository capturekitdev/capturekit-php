<?php

declare(strict_types=1);

namespace CaptureKit\Exception;

use CaptureKit\RawResponse;

/**
 * A successful response could not be decoded as the documented representation.
 */
final class ResponseDecodingException extends CaptureKitException
{
    public function __construct(string $message, public readonly RawResponse $rawResponse)
    {
        parent::__construct($message);
    }
}
