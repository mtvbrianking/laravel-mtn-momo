<?php
/**
 * Token.php.
 */

namespace Bmatovu\MtnMomo\Model;

use Bmatovu\MtnMomo\Traits\TokenUtilTrait;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Token.
 */
class Token extends BaseModel implements TokenInterface
{
    use TokenUtilTrait;

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
        'access_token', 'token_type', 'expires_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at', 'deleted_at',
    ];
}
