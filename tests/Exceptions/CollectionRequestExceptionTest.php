<?php

namespace Bmatovu\MtnMomo\Tests\Exceptions;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

class CollectionRequestExceptionTest extends TestCase
{
    public function test_exception_formation()
    {
        $this->expectException(CollectionRequestException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Something went wrong.');

        $apiRequest = new Request('GET', 'http://example.bad/request');

        $apiResponse = new Response(400, [], json_encode([
            'error' => 'Mal-formed request.',
        ]));

        $request_exception = new RequestException('Resulted into Bad request.', $apiRequest, $apiResponse);

        $collection_exception = new CollectionRequestException('Something went wrong.', 0, $request_exception);

        $this->assertInstanceOf(RequestException::class, $collection_exception->getPrevious());

        $this->assertEquals($collection_exception->getPrevious()->getCode(), 400);

        $this->assertEquals($collection_exception->getPrevious()->getMessage(), 'Resulted into Bad request.');

        throw $collection_exception;
    }
}
