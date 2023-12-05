<?php

namespace App\WeMovieRetrieval;

use App\Entity\Movie;
use App\Entity\WeMoviesEntity;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

// Classe pour recuperer les films par genre
class MoviesSearchStrategy extends WeMovieRetrieval implements WeMovieStrategyInterface
{
    private const RELATIVE_URL = 'search/movie?query=';
    private const SEARCH_PARAM = 'search_value';


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

        // On enleve les valeurs de date "" pour eviter de faire "peter" le dateTimeDeNormalizer
        // Qui n aime pas les valeurs null ou ""
        array_walk($genreJsonArr['results'], function(&$value){
            $releasedDate = trim($value['release_date']);
            if(empty($releasedDate)) {
                unset($value['release_date']);
            }
        });

        return  $this->serializer->deserialize(json_encode($genreJsonArr['results']),  Movie::class.'[]', self::JSON_FORMAT);

    }

}

