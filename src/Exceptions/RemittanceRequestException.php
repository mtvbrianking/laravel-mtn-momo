<?php
/**
 * RemittanceRequestException.
 */

namespace Bmatovu\MtnMomo\Exceptions;

use RuntimeException;

/**
 * Custom remittance request exception.
 */
class RemittanceRequestException extends RuntimeException implements MtnMomoRequestException
{
    /**
     * Constructor.
     *
     * @param string $message
     * @param int $code
     * @param \GuzzleHttp\Exception\TransferException $guzzle_exception
     */
    public function __construct($message, $code = 0, $guzzle_exception = null)
    {
        parent::__construct($message, $code, $guzzle_exception);
    }
}
