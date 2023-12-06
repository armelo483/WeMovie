<?php

namespace App\WeMovieRetrieval;

use App\Entity\Movie;
use App\Entity\WeMoviesEntity;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MoviesByGenreStrategy extends WeMovieRetrieval implements WeMovieStrategyInterface
{
    private const RELATIVE_URL = 'discover/movie?with_genres=';
    private const SEARCH_PARAM = 'genre_id';

    /**
     * @param array|null $options
     * @return array|Movie
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getWeMovieData(?array $options = []): array|Movie
    {
        $this->configureOptions(self::SEARCH_PARAM);
        $options = $this->resolver->resolve($options);
        $genreJsonArr = parent::getArrayFromJson(self::RELATIVE_URL.$options[self::SEARCH_PARAM]);

        return  $this->serializer->deserialize(json_encode($genreJsonArr['results']),  Movie::class.'[]', WeMovieRetrieval::JSON_FORMAT);

    }

    protected function configureOptions(string $propertyName): void
    {
        parent::configureOptions($propertyName);
        $this->resolver->setAllowedTypes(self::SEARCH_PARAM, [self::INT_FORMAT]);
    }

}