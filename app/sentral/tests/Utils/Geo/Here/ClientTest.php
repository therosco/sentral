<?php
namespace App\Tests\Utils\Geo\Here;

use App\Utils\Geo\Here\Client;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

class ClientTest extends TestCase
{
    public function testAdd()
    {
        $client = new ClientStub('', '');

        $response = <<<RESP
        {
            "response":{
               "metaInfo":{
                  "timestamp":"2018-09-23T02:51:59Z",
                  "mapVersion":"8.30.88.155",
                  "moduleVersion":"7.2.201836-40190",
                  "interfaceVersion":"2.6.34",
                  "availableMapVersion":[
                     "8.30.88.155"
                  ]
               },
               "route":[
                  {
                     "waypoint":[
                        {
                           "linkId":"+989160956",
                           "mappedPosition":{
                              "latitude":-32.9966748,
                              "longitude":151.0176586
                           },
                           "originalPosition":{
                              "latitude":-33.0,
                              "longitude":151.0
                           },
                           "type":"stopOver",
                           "spot":0.4772727,
                           "sideOfStreet":"neither",
                           "mappedRoadName":"Yango Trak",
                           "label":"Yango Trak",
                           "shapeIndex":0
                        },
                        {
                           "linkId":"+989160956",
                           "mappedPosition":{
                              "latitude":-32.9966748,
                              "longitude":151.0176586
                           },
                           "originalPosition":{
                              "latitude":-33.0,
                              "longitude":151.0
                           },
                           "type":"stopOver",
                           "spot":0.4772727,
                           "sideOfStreet":"neither",
                           "mappedRoadName":"Yango Trak",
                           "label":"Yango Trak",
                           "shapeIndex":1
                        }
                     ],
                     "mode":{
                        "type":"fastest",
                        "transportModes":[
                           "car"
                        ],
                        "trafficMode":"disabled",
                        "feature":[
         
                        ]
                     },
                     "leg":[
                        {
                           "start":{
                              "linkId":"+989160956",
                              "mappedPosition":{
                                 "latitude":-32.9966748,
                                 "longitude":151.0176586
                              },
                              "originalPosition":{
                                 "latitude":-33.0,
                                 "longitude":151.0
                              },
                              "type":"stopOver",
                              "spot":0.4772727,
                              "sideOfStreet":"neither",
                              "mappedRoadName":"Yango Trak",
                              "label":"Yango Trak",
                              "shapeIndex":0
                           },
                           "end":{
                              "linkId":"+989160956",
                              "mappedPosition":{
                                 "latitude":-32.9966748,
                                 "longitude":151.0176586
                              },
                              "originalPosition":{
                                 "latitude":-33.0,
                                 "longitude":151.0
                              },
                              "type":"stopOver",
                              "spot":0.4772727,
                              "sideOfStreet":"neither",
                              "mappedRoadName":"Yango Trak",
                              "label":"Yango Trak",
                              "shapeIndex":1
                           },
                           "length":3368,
                           "travelTime":434,
                           "maneuver":[
                              {
                                 "position":{
                                    "latitude":-32.9966748,
                                    "longitude":151.0176586
                                 },
                                 "instruction":"Head <span class=\"heading\">north</span> on <span class=\"street\">Yango Trak</span>. <span class=\"distance-description\">Go for <span class=\"length\">1.7 km</span>.</span>",
                                 "travelTime":217,
                                 "length":1684,
                                 "id":"M1",
                                 "_type":"PrivateTransportManeuverType"
                              },
                              {
                                 "position":{
                                    "latitude":-32.9966748,
                                    "longitude":151.0176586
                                 },
                                 "instruction":"Arrive at <span class=\"street\">Yango Trak</span>.",
                                 "travelTime":217,
                                 "length":1684,
                                 "id":"M2",
                                 "_type":"PrivateTransportManeuverType"
                              }
                           ]
                        }
                     ],
                     "summary":{
                        "distance":3368,
                        "trafficTime":434,
                        "baseTime":434,
                        "flags":[
                           "dirtRoad"
                        ],
                        "text":"The trip takes <span class=\"length\">3.4 km</span> and <span class=\"time\">7 mins</span>.",
                        "travelTime":434,
                        "_type":"RouteSummaryType"
                     }
                  }
               ],
               "language":"en-us"
            }
         }
RESP;
        $client->setMockHandler(
            new MockHandler([
                new Response(200, [], $response),
            ])
        );

        $this->assertEquals(
            [
                "distance"    => 3368,
                "trafficTime" => 434,
                "baseTime"    => 434,
                "flags"       => ["dirtRoad"],
                "text"        => "The trip takes <span class=\"length\">3.4 km</span> and <span class=\"time\">7 mins</span>.",
                "travelTime"  => 434,
                "_type"       => "RouteSummaryType"
            ], 
            $client->getRouteInfo(-33.7980713,151.1809679,-33.8003407,151.1848283)
        );
    }
}