<?php
// src/EventListener/ProductionCountriesListener.php

namespace App\EventListener;

use App\Entity\Movie;
use App\ValueObject\ProductionCountry;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Serializer\Event\PostDeserializeEvent;

class ProductionCountriesListener
{
    public function postLoad(Movie $entity, LifecycleEventArgs $event)
    {
        dd($entity);
        if ($entity instanceof Movie) {
            $productionCountriesData = $entity->getProductionCountries();
            $productionCountries = [];

            foreach ($productionCountriesData as $data) {
                dd($data);
                $productionCountries[] = new ProductionCountry($data['countryName']);
            }

            $entity->setProductionCountries($productionCountries);
        }
    }
}
