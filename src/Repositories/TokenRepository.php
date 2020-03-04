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
     * Product.
     *
     * @var string
     */
    protected $product;

    /**
     * Constructor.
     *
     * @param string $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes)
    {
        $attributes['token_type'] = 'Bearer';
        $attributes['product'] = $this->product;

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
        return Token::where('product', $this->product)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve($access_token = null)
    {
        if ($access_token) {
            return Token::query()
                ->where('access_token', $access_token)
                ->where('product', $this->product)
                ->first();
        }

        return Token::query()
            ->where('product', $this->product)
            ->latest('created_at')
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function update($access_token, array $attributes)
    {
        $token = Token::query()
            ->where('access_token', $access_token)
            ->where('product', $this->product)
            ->first();

        $token->update($attributes);

        return $token->fresh();
    }

    /**
     * {@inheritdoc}
     */
    public function delete($access_token)
    {
        Token::query()
            ->where('access_token', $access_token)
            ->where('product', $this->product)
            ->delete();
    }
}
