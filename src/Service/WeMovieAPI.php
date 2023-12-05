<?php

declare(strict_types=1);

namespace App\Service;

// Classe chargée de receptionner les données et d'hydrater le valueObject WeMovie et servant d interface au controller


use App\Entity\WeMoviesEntity;
use App\WeMovieRetrieval\WeMovieStrategyInterface;

class WeMovieAPI implements WeMovieAPIInterface
{
    private WeMovieStrategyInterface $weMovieRetrievalStrategy;

    /**
     * @param array|null $options
     * @return array|WeMoviesEntity
     */
    public function get(?array $options = []): array|WeMoviesEntity
    {
        return $this->weMovieRetrievalStrategy->getWeMovieData($options);
    }

    public function setWeMovieRetrievalStrategy(WeMovieStrategyInterface $weMovieRetrievalStrategy): WeMovieAPIInterface
    {
        $this->weMovieRetrievalStrategy = $weMovieRetrievalStrategy;
        return $this;
    }
}