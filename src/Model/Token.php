<?php

namespace Bmatovu\MtnMomo\Model;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Token extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mtn_momo_tokens';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Get refresh token.
     *
     * Odd; same as access token.
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->access_token;
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

        if ($this->expires_at->isFuture()) {
            return false;
        }

        return true;
    }
}
