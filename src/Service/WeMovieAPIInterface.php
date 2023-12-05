<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\WeMoviesEntity;
use App\WeMovieRetrieval\MovieRetrievalStrategyStrategyInterface;
use App\WeMovieRetrieval\WeMovieStrategyInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface WeMovieAPIInterface
{
    /**
     * @param SearchParam|null $searchParam
     * @return array|WeMoviesEntity
     */
    public function get(?array $options = []): array|WeMoviesEntity;
    public function setWeMovieRetrievalStrategy(WeMovieStrategyInterface $movieRetrievalStrategy): WeMovieAPIInterface;

}