<?php
/**
 * TokenInterface.
 */

namespace Bmatovu\MtnMomo\Models;

/**
 * Interface TokenInterface.
 */
interface TokenInterface
{
    /**
     * Get access token.
     * @return string
     */
    public function getAccessToken();

    /**
     * Get refresh token.
     *
     * @return string|null
     */
    public function getRefreshToken();

    /**
     * Get token type.
     *
     * @return string
     */
    public function getTokenType();

    /**
     * Get expires at.
     *
     * @return string Datetime
     */
    public function getExpiresAt();

    /**
     * Determine if token is expired.
     *
     * @return bool
     */
    public function isExpired();
}
