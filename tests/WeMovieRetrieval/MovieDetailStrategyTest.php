<?php

namespace App\Tests\WeMovieRetrieval;

use App\Entity\Movie;
use App\Tests\WeMovieRetrieval\WeMovieRetrievalStrategyTest;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MovieDetailStrategyTest extends WeMovieRetrievalStrategyTest
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetWeMovieData()
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getContent')->willReturn('{
          "adult": false,
          "backdrop_path": "/xJHokMbljvjADYdit5fK5VQsXEG.jpg",
          "belongs_to_collection": null,
          "budget": 165000000,
          "tagline": "Mankind was born on Earth. It was never meant to die here.",
          "title": "Interstellar",
          "video": false,
          "vote_average": 8.421,
          "vote_count": 33039,
          "id": 4
        }');

        $this->httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'movie/4')
            ->willReturn($responseMock);


        $movie = $this->weMovieRetrieval->getWeMovieData(['movie_id' => 4]);

        $this->assertInstanceOf(Movie::class, $movie);
    }

}