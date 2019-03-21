<?php

namespace Bmatovu\MtnMomo\Http;

interface GrantTypeInterface
{
    /**
     * Obtain the token data returned by the OAuth2 server.
     *
     * @param string $grantType Name
     * @param string $refreshToken
     *
     * @return array
     */
    public function getToken($grantType = 'client_credentials', $refreshToken = null);
}
