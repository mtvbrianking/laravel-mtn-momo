<?php
/**
 * TokenRepository.
 */

namespace Bmatovu\MtnMomo\Repositories;

use Carbon\Carbon;
use Bmatovu\MtnMomo\Models\Token;

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
        // slience is golden...
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes)
    {
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

        return Token::whereNull('deleted_at')->latest('created_at')->first();
    }

    /**
     * {@inheritdoc}
     */
    public function update($access_token, array $attributes)
    {
        // $model->fresh()
        // $model->refresh()
        return $this->get($access_token)->update($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($access_token)
    {
        Token::destory($access_token);
        /*
        $token = $this->get($access_token);

        if(!$token) {
            return;
        }

        $token->deleted_at = Carbon::now();
        $token->save();
        */
    }
}
