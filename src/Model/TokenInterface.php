<?php
/**
 * TokenInterface
 */

namespace Bmatovu\MtnMomo\Model;

/**
 * Interface TokenInterface
 *
 * @package Bmatovu\MtnMomo\Model
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
     * @return boolean
     */
    public function isExpired();
}
