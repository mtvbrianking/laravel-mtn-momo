<?php
namespace Bmatovu\MtnMomo\Tests\Repositories;

use Carbon\Carbon;
use Bmatovu\MtnMomo\Models\Token;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Bmatovu\MtnMomo\Repositories\TokenRepository;
use Bmatovu\OAuthNegotiator\Models\TokenInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface;

/**
 * @see \Bmatovu\MtnMomo\Repositories\TokenRepository
 */
class TokenRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_token()
    {
        $tokenAttrs = [
            'access_token' => str_random(60),
            'refresh_token' => str_random(60),
            'token_type' => 'Bearer',
            'expires_in' => 3600,
        ];

        $tokenRepo = new TokenRepository();

        $this->assertInstanceOf(TokenRepositoryInterface::class, $tokenRepo);

        $token = $tokenRepo->create($tokenAttrs);

        $this->assertInstanceOf(TokenInterface::class, $token);

        $this->assertInstanceOf(Carbon::class, $token->getExpiresAt());
    }

    public function test_can_retrieve_all_tokens()
    {
        factory(Token::class, 3)->create();

        $tokenRepo = new TokenRepository();

        $tokens = $tokenRepo->retrieveAll();

        $this->assertInstanceOf(Collection::class, $tokens);

        $this->assertEquals(3, $tokens->count());
    }

    public function test_can_retrieve_token_access_token()
    {
        factory(Token::class, 2)->create();

        $access_token = str_random(60);

        factory(Token::class)->create([
            'access_token' => $access_token,
        ]);

        $tokenRepo = new TokenRepository();

        $token = $tokenRepo->retrieve($access_token);

        $this->assertNotInstanceOf(Collection::class, $token);

        $this->assertInstanceOf(Token::class, $token);

        $this->assertEquals($access_token, $token->getAccessToken());

        // Test retrieving non-existent token

        $access_token = str_random(60);

        $token = $tokenRepo->retrieve($access_token);

        $this->assertNull($token);
    }

    public function test_can_retrieve_lastest_token()
    {
        $tokenRepo = new TokenRepository();

        $token = $tokenRepo->retrieve();

        $this->assertNull($token);

        // ...

        factory(Token::class, 2)->create();

        $access_token = str_random(60);

        factory(Token::class)->create([
            'access_token' => $access_token,
            'created_at' => Carbon::now()->addSeconds(10),
        ]);

        $tokenRepo = new TokenRepository();

        $token = $tokenRepo->retrieve();

        $this->assertInstanceOf(Token::class, $token);

        $this->assertEquals($access_token, $token->getAccessToken());
    }

    public function test_can_update_token()
    {
        $org_access_token = str_random(60);

        $org_token = factory(Token::class)->create([
            'access_token' => $org_access_token,
        ]);

        // ...

        $tokenRepo = new TokenRepository();

        $new_access_token = str_random(60);
        $new_refresh_token = str_random(60);
        $new_token_type = 'New_Bearer';

        $new_token = $tokenRepo->update($org_access_token, [
            'access_token' => $new_access_token,
            'refresh_token' => $new_refresh_token,
            'token_type' => $new_token_type,
            'expires_at' => 3600,
        ]);

        $this->assertEquals($new_access_token, $new_token->getAccessToken());
        $this->assertEquals($new_refresh_token, $new_token->getRefreshToken());
        $this->assertEquals($new_token_type, $new_token->getTokenType());
        $this->assertInstanceOf(Carbon::class, $new_token->getExpiresAt());
        $this->assertNotEquals($org_token->getExpiresAt()->format('Y-m-d H:i:s'), $new_token->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public function test_can_delete_token()
    {
        $access_token = str_random(60);

        $token = factory(Token::class)->create([
            'access_token' => $access_token,
        ]);

        $table = $token->getTable();

        $tokenRepo = new TokenRepository();

        $tokenRepo->delete($access_token);

        $this->missingFromDatabase($table, [
            'access_token' => $access_token,
        ]);
    }

}
