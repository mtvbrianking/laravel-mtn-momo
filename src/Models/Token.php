<?php
/**
 * Token.
 */

namespace Bmatovu\MtnMomo\Models;

use Carbon\Carbon;
use Bmatovu\MtnMomo\Traits\TokenUtilTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bmatovu\OAuthNegotiator\Models\TokenInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Token.
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

    /**
     * Set token expiration.
     *
     * Dynamically change 'exipres_in' to 'expires_at'.
     *
     * @param  int  $value
     *
     * @return void
     */
    public function setExpiresInAttribute($value)
    {
        if(!is_int($value)) {
            return;
        }

        $this->attributes['expires_at'] = Carbon::now()->addSeconds($value)->format('Y-m-d H:i:s');
    }
}
