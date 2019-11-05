<?php
/**
 * Token.
 */

namespace Bmatovu\MtnMomo\Models;

use Bmatovu\MtnMomo\Traits\TokenUtilTrait;
use Bmatovu\OAuthNegotiator\Models\TokenInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Token model.
 */
class Token extends BaseModel implements TokenInterface
{
    use SoftDeletes, TokenUtilTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mtn_momo_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_token',
        'refresh_token',
        'token_type',
        'expires_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
        'deleted_at',
    ];
}
