<?php
namespace Bmatovu\MtnMomo\Tests\Models;

use Carbon\Carbon;
use Bmatovu\MtnMomo\Models\Token;
use Bmatovu\MtnMomo\Tests\TestCase;
use Bmatovu\OAuthNegotiator\Models\TokenInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @see \Bmatovu\MtnMomo\Models\Token
 */
class TokenTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_token()
    {
        $access_token = str_random(60);
        $refresh_token = str_random(60);
        $token_type = 'Bearer';
        $expires_at = Carbon::now();

        $token = Token::create([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'token_type' => $token_type,
            'expires_at' => $expires_at,
        ]);

        $this->assertInstanceOf(Token::class, $token);

        $this->assertInstanceOf(TokenInterface::class, $token);

        $this->assertEquals('mtn_momo_tokens', $token->getTable());

        $this->assertDatabaseHas('mtn_momo_tokens', [
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'token_type' => $token_type,
            'expires_at' => $expires_at,
            'deleted_at' => null,
        ]);
    }

    public function test_getters()
    {
        $access_token = str_random(60);
        $refresh_token = str_random(60);
        $token_type = 'Bearer';
        $expires_at = Carbon::now();

        $token = Token::create([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'token_type' => $token_type,
            'expires_at' => $expires_at,
        ]);

        $this->assertEquals($access_token, $token->getAccessToken());
        $this->assertEquals($refresh_token, $token->getRefreshToken());
        $this->assertEquals($token_type, $token->getTokenType());
        $this->assertInstanceOf(Carbon::class, $token->getExpiresAt());
        $this->assertEquals($expires_at->format('Y-m-d H:i:s'), $token->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public function test_determines_expired()
    {
        $token = factory(Token::class)->create([
            'expires_at' => Carbon::now()->addSeconds(3600),
        ]);

        $this->assertFalse($token->isExpired());

        $token->expires_at = Carbon::now()->subSeconds(3600);
        $token->fresh();

        $this->assertTrue($token->isExpired());
    }
}
