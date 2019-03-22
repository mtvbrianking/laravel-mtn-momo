<?php

namespace Bmatovu\MtnMomo\Http\GrantType;

use Bmatovu\MtnMomo\Http\GrantTypeInterface;

class RefreshToken implements GrantTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function getToken($grantType = 'refresh_token', $refreshToken = null)
    {
        // TODO
    }
}
