<?php

namespace App\WeMovieRetrieval;

use App\Entity\Movie;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
class BestRatedMovieStrategy extends WeMovieRetrieval implements WeMovieStrategyInterface
{
    private const RELATIVE_URL = 'movie/';
    private const TOP_RATED = 'top_rated';
    private const VIDEOS = 'videos';

    /**
     * @param array|null $options
     * @return Movie
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getWeMovieData(?array $options = []): Movie
    {
        // Code a mettre soit dans un trait soit dans la classe parent, car se repete (DRY violée)
        $ratedMoviesJsonArr = parent::getArrayFromJson(self::RELATIVE_URL.self::TOP_RATED);
        $topRatedMovies = $this->serializer->deserialize(json_encode($ratedMoviesJsonArr['results']),  Movie::class.'[]', self::JSON_FORMAT);
        $bestRatedMovie = current($topRatedMovies);
        $bestVideosUrl = self::RELATIVE_URL.$bestRatedMovie->getId().'/'.self::VIDEOS;
        $bestVideos = parent::getArrayFromJson($bestVideosUrl);
        $bestVideo = current($bestVideos['results']);

        $bestRatedMovie->setYoutubeVideoId($bestVideo['key']??'');

        return $bestRatedMovie;
    }
}