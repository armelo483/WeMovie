<?php

namespace App\WeMovieRetrieval;

use App\Entity\Movie;

interface MovieRetrievalStrategyStrategyInterface extends WeMovieStrategyInterface
{
    /**
     * @return array<Movie>
     */
    public function getMovies(): array;
}