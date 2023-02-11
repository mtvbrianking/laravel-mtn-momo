<?php

/**
 * TokenUtilTrait.
 */

namespace Bmatovu\MtnMomo\Traits;

/**
 * Token model utilities.
 */
trait TokenUtilTrait
{
    /**
     * Get access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Get refresh token.
     *
     * @return string|null
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Get token type.
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * Get product.
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Get expires at.
     *
     * @return string|\Datetime
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Determine if a token is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        if (is_null($this->expires_at)) {
            return false;
        }

        return $this->expires_at->isPast();
    }
}
