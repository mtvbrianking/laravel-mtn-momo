<?php
/**
 * TokenRepository.
 */

namespace Bmatovu\MtnMomo\Repositories;

use Bmatovu\MtnMomo\Models\Token;
use Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface;
use Carbon\Carbon;

/**
 * Token repository.
 */
class TokenRepository implements TokenRepositoryInterface
{
    /**
     * @var string The product whose token you are looking for.
     */
    protected $product_type;

    /**
     * TokenRepository constructor.
     * @param string $product_type Product type I.E collection, disbursement
     */
    public function __construct(string $product_type)
    {
        $this->product_type = $product_type;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes)
    {
        $attributes['token_type'] = 'Bearer';

        if(empty($attributes['product_type'])){
            $attributes['product_type'] = $this->product_type;
        }

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

        return Token::where('product_type',$this->product_type)->latest('created_at')->first();
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
