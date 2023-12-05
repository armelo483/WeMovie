<?php

namespace App\Tests\WeMovieRetrieval;

use App\Entity\Genre;
use App\WeMovieRetrieval\GenreRetrievalStrategy;
use App\WeMovieRetrieval\WeMovieRetrieval;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GenreRetrievalStrategyTest extends WeMovieRetrievalStrategyTest
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
        $responseMock->method('getContent')->willReturn('{"genres":[{"id":1,"name":"Action"},{"id":2,"name":"Drama"}]}');
        $this->httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'genre/movie/list?language=en')
            ->willReturn($responseMock);


        $result = $this->weMovieRetrieval->getWeMovieData();
        $this->assertIsArray($result);

        foreach ($result as $genre) {
            $this->assertInstanceOf(Genre::class, $genre);
        }
    }

}