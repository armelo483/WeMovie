<?php

namespace App\WeMovieRetrieval;

// Classe pour recuperer tous les genres disponibles
use App\Entity\Genre;
use App\Entity\WeMoviesEntity;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GenreRetrievalStrategy extends WeMovieRetrieval  implements WeMovieStrategyInterface
{
    private const RELATIVE_URL = 'genre/movie/list?language=en';


    /**
     * @param array|null $options
     * @return array|Genre
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getWeMovieData(?array $options = []): array|Genre
    {
        $genreJsonArr = parent::getArrayFromJson(self::RELATIVE_URL);
        return  $this->serializer->deserialize(json_encode($genreJsonArr['genres']),  Genre::class.'[]', self::JSON_FORMAT);

    }
}