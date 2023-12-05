<?php

namespace App\Tests\WeMovieRetrieval;

use App\Entity\Movie;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MoviesByGenreStrategyTest extends WeMovieRetrievalStrategyTest
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
              "results": [
                    {
                      "genre_ids": [
                        16,
                        35,
                        10751
                      ],
                      "id": 1075794,
                      "original_language": "en",
                      "original_title": "Leo",
                      "overview": "Jaded 74-year-old.",
                      "popularity": 1775.756,
                      "poster_path": "/pD6sL4vntUOXHmuvJPPZAgvyfd9.jpg"
                    }
                ]
        }');

        $this->httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'discover/movie?with_genres=16')
            ->willReturn($responseMock);


        $result = $this->weMovieRetrieval->getWeMovieData(['genre_id' => 16]);
        $this->assertIsArray($result);

        foreach ($result as $movie) {
            $this->assertInstanceOf(Movie::class, $movie);
        }
    }

}