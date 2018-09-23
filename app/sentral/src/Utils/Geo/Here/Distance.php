<?php
namespace App\Utils\Geo\Here;

use App\Utils\Geo\DistanceInterface;

class Distance implements DistanceInterface {
    private $client = null;

    private $cache = [];

    public function __construct(Client $client) {
        $this->client = $client;
    }

    private function getRouteInfo(float $latitude1, float $longitude1, float $latitude2, float $longitude2): array {
        $key = sprintf(
            '%s_%s_%s_%s',
            $latitude1,
            $longitude1, 
            $latitude2, 
            $longitude2
        );
        if (! isset($this->cache[$key])) {
            $this->cache[$key] = $this->client->getRouteInfo($latitude1, $longitude1, $latitude2, $longitude2);
        }

        return $this->cache[$key];
    }

    public function getDistance(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float {
        $info = $this->getRouteInfo($latitude1, $longitude1, $latitude2, $longitude2);

        return $info["distance"];
    }

    public function getTravelTimeMinutes(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float {
        $info = $this->getRouteInfo($latitude1, $longitude1, $latitude2, $longitude2);

        return $info["baseTime"] / 60;
    }
}