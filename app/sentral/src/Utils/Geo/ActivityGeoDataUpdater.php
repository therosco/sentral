<?php
namespace App\Utils\Geo;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Activity;
use App\Entity\Venue;

class ActivityGeoDataUpdater {
    private $geoService = null;

    public function __construct(DistanceInterface $geoService) {
        $this->geoService = $geoService;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Activity) {
            return;
        }

        $this->calculateGeoFields($entity, $args->getObjectManager());
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Activity) {
            return;
        }

        $this->calculateGeoFields($entity, $args->getObjectManager());
    }

    private function calculateGeoFields(Activity $activity, ObjectManager $objectManager): void {
        $currentVenue = $activity->getVenue();
        $defaultVenue = $objectManager->getRepository(Venue::class)->findDefaultVenue();
        if (!$defaultVenue) {
            return; //it's not so important, postpone to the next time
        }

        try {
            $activity->setDistance(
                $this->geoService->getDistance(
                    $currentVenue->getLatitude(), 
                    $currentVenue->getLongitude(), 
                    $defaultVenue->getLatitude(),
                    $currentVenue->getLongitude()
                )
            );

            $activity->setTravelTimeMinutes(
                $this->geoService->getTravelTimeMinutes(
                    $currentVenue->getLatitude(), 
                    $currentVenue->getLongitude(), 
                    $defaultVenue->getLatitude(),
                    $currentVenue->getLongitude()
                )
            );
        }
        catch(\Throwable $e) {
            error_log($e->getMessage());
            //still not so important
        }
    }
}