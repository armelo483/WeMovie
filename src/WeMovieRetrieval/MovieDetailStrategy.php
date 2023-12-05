<?php

namespace App\WeMovieRetrieval;

use App\Entity\Movie;
use App\Entity\WeMoviesEntity;
use App\WeMovieRetrieval\WeMovieRetrieval;
use App\WeMovieRetrieval\WeMovieStrategyInterface;
use JMS\Serializer\Handler\EnumHandler;
use JMS\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MovieDetailStrategy extends WeMovieRetrieval implements WeMovieStrategyInterface
{
    private const SEARCH_PARAM = 'movie_id';
    private const RELATIVE_URL = 'movie/';


    /**
     * @param array|null $options
     * @return Movie
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getWeMovieData(?array $options = []): Movie
    {
        $this->configureOptions(self::SEARCH_PARAM);
        $options = $this->resolver->resolve($options);

        $genreJsonArr = parent::getArrayFromJson(self::RELATIVE_URL.$options[self::SEARCH_PARAM]);

        if(empty($genreJsonArr['release_date'])) {
            unset($genreJsonArr['release_date']);
        }

        return  $this->serializer->deserialize(json_encode($genreJsonArr),  Movie::class, self::JSON_FORMAT);

    }

    protected function configureOptions(string $propertyName): void
    {
        parent::configureOptions($propertyName);
        $this->resolver->setAllowedTypes(self::SEARCH_PARAM, [self::INT_FORMAT]);
    }
}