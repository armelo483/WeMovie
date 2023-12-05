<?php

namespace App\WeMovieRetrieval;

use App\Entity\WeMoviesEntity;

interface WeMovieStrategyInterface
{
    /**
     * @param array|null $options
     * @return array|WeMoviesEntity
     */
    public function getWeMovieData(?array $options = []): array|WeMoviesEntity;


}