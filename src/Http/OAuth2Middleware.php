<?php

namespace Bmatovu\MtnMomo\Http;

use Bmatovu\MtnMomo\Model\Token;
use Psr\Http\Message\RequestInterface;
use Bmatovu\MtnMomo\Exception\AccessTokenRequestException;

class OAuth2Middleware
{
    /**
     * The grant type implementation used to acquire access tokens.
     *
     * @var \Bmatovu\MtnMomo\Http\GrantTypeInterface
     */
    protected $grantType;

    /**
     * The grant type implementation used to refresh access tokens.
     *
     * @var \Bmatovu\MtnMomo\Http\GrantTypeInterface
     */
    protected $refreshTokenGrantType;

    /**
     * The model including access token.
     *
     * @var \Bmatovu\MtnMomo\Model\Token
     */
    protected $token;

    /**
     * @param \Bmatovu\MtnMomo\Http\GrantTypeInterface $grantType
     * @param \Bmatovu\MtnMomo\Http\GrantTypeInterface $refreshTokenGrantType
     */
    public function __construct($grantType, $refreshTokenGrantType = null)
    {
        $this->grantType = $grantType;
        $this->refreshTokenGrantType = $refreshTokenGrantType;
    }

    /**
     * Guzzle middleware invocation.
     *
     * @param callable $handler
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $request = $this->signRequest($request);
        };
    }

    protected function signRequest($request)
    {
        $token = $this->getToken();

        if ($token === null) {
            return $request;
        }

        $request->withHeader('Authorization', 'Bearer '.$token->access_token);
    }

    /**
     * Get a valid access token.
     *
     * @return \Bmatovu\MtnMomo\Model\Token|null
     *
     * @throws AccessTokenRequestException
     */
    public function getToken()
    {
        // If token is not set try to get it from the persistent storage.
        if ($this->token === null) {
            $this->token = Token::latest('created_at')->first();
        }

        // If token is not set or expired then try to acquire a new one...
        if ($this->token === null || $this->token->isExpired()) {

            // Hydrate `rawToken` with a new access token
            $this->token = $this->requestNewToken();
        }

        return $this->token;
    }

    /**
     * Acquire a new access token from the server.
     *
     * @return \Bmatovu\MtnMomo\Model\Token|null
     *
     * @throws AccessTokenRequestException
     */
    protected function requestNewToken()
    {
        // TRY REFRESHING ACCESS TOKEN
        // if ($this->refreshTokenGrantType && $this->token && $this->token->getRefreshToken()) {
        //     try {
        //         Log::debug('Refresh existing token', ['refresh_token' => $this->token->getRefreshToken()]);

        //         // Get an access token using the stored refresh token.
        //         $rawData = $this->refreshTokenGrantType->getRawData(
        //             $this->clientCredentialsSigner,
        //             $this->token->getRefreshToken()
        //         );

        //         $this->token = $this->tokenFactory($rawData, $this->token);

        //         return;
        //     } catch (BadResponseException $e) {
        //         // If the refresh token is invalid, then clear the entire token information.
        //         Log::error('Refresh existing token', [
        //             'exception' => $ex->getMessage(),
        //         ]);
        //         $this->token = null;
        //     }
        // }

        try {
            // Request an access token using the main grant type.
            $api_token = $this->grantType->getToken();

            // Save token
            $token = new Token();
            $token->access_token = $api_token->access_token;
            $token->token_type = $api_token->token_type;
            $token->expires_at = Carbon::now()->addSeconds($api_token->expires_in);
            $token->save();

            return $token;
        } catch (BadResponseException $ex) {
            throw new AccessTokenRequestException('Unable to request a new access token', $ex->getPrevious());
        }
    }
}
