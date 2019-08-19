<?php
/**
 * TokenRepository.
 */

namespace Bmatovu\MtnMomo\Repositories;

use Carbon\Carbon;
use Bmatovu\MtnMomo\Models\Token;
use Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface;

/**
 * Class TokenRepository.
 */
class TokenRepository implements TokenRepositoryInterface
{
    /**
     * Constructor.
     */
    public function __constructor()
    {
        // Silence is golden...
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes)
    {
        $attributes['token_type'] = 'Bearer';

        if (isset($attributes['expires_in'])) {
            $attributes['expires_at'] = Carbon::now()->addSeconds($attributes['expires_in']);
        }

        return Token::create($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveAll()
    {
        return Token::all();
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve($access_token = null)
    {
        if ($access_token) {
            return Token::where('access_token', $access_token)->first();
        }

        return Token::latest('created_at')->first();
    }

    /**
     * {@inheritdoc}
     */
    public function update($access_token, array $attributes)
    {
        $token = Token::where('access_token', $access_token)->first();

        $token->update($attributes);

        return $token->fresh();
    }

    /**
     * {@inheritdoc}
     */
    public function delete($access_token)
    {
        Token::where('access_token', $access_token)->delete();
    }
}
