<?php
namespace App\Utils\Geo\Here;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client {
    private $appId = '';
    private $appCode = '';

    private $guzzleHttpClient = null;

    public function __construct(string $appId, string $appCode) {
        $this->appId = $appId;
        $this->appCode = $appCode;
    }

    protected function createGuzzleClient(): GuzzleHttpClient {
        return new GuzzleHttpClient([
            'base_uri' => 'https://route.api.here.com/routing/7.2/',
            'timeout'  => 7.0,
        ]);
    }

    public function getRouteInfo(float $latitude1, float $longitude1, float $latitude2, float $longitude2): array {
        if (null === $this->guzzleHttpClient) {
            $this->guzzleHttpClient = $this->createGuzzleClient();
        }
        $response = $this->guzzleHttpClient->request(
            'GET', 
            'calculateroute.json', 
            [
                'query' => http_build_query([
                    'app_id'    => $this->appId,
                    'app_code'  => $this->appCode,
                    'waypoint0' => sprintf('geo!%f,%f', $latitude1, $longitude1),
                    'waypoint1' => sprintf('geo!%f,%f', $latitude2, $longitude2),
                    'mode'      => 'fastest;car;traffic:disabled'
                ])
            ]
        );

        if ($response->getStatusCode() >= 400) {
            throw new \Exception('Bad server response: '.$response->getStatusCode());
        }

        $contents = $response->getBody()->getContents();
        if (!$contents || false === ($json = json_decode($contents, true)) || !isset($json['response']['route'][0]['summary'])) {
            throw new \Exception('Unexpected data recieved from server '.serialize($contents));
        }

        return $json['response']['route'][0]['summary'];
    }
}