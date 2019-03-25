<?php
/**
 * RefreshToken.php
 */

namespace Bmatovu\MtnMomo\Http\GrantType;

use Bmatovu\MtnMomo\Http\GrantTypeInterface;

/**
 * Class RefreshToken
 *
 * @package Bmatovu\MtnMomo\Http\GrantType
 */
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
