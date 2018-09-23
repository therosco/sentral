<?php
namespace App\Tests\Utils\Geo\Here;

use App\Utils\Geo\Here\Client;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleHttpClient;

class ClientStub extends Client {
    private $mockHandler = null;

    public function setMockHandler(MockHandler $mockHandler) {
        $this->mockHandler = $mockHandler;
    }

    protected function createGuzzleClient(): GuzzleHttpClient {
        if (null === $this->mockHandler) {
            throw new \Exception("You must set a MockHandler before using this stub");
        }
        $handler = HandlerStack::create($this->mockHandler);
        return new GuzzleHttpClient(['handler' => $handler]);
    }
}