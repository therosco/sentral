<?php
namespace App\Utils\Geo;

interface DistanceInterface {
    public function getDistance(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float;
    public function getTravelTimeMinutes(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float;
}