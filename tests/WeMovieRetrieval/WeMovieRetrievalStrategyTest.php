<?php

namespace App\Tests\WeMovieRetrieval;

use App\WeMovieRetrieval\WeMovieRetrieval;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeMovieRetrievalStrategyTest extends KernelTestCase
{
    protected static $sharedData;
    protected  HttpClientInterface $httpClient;
    private ?SerializerInterface $serializer;
    protected  WeMovieRetrieval $weMovieRetrieval;

    public static function setUpBeforeClass(): void
    {
        self::$sharedData = 'Some shared data';
    }

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        self::bootKernel();
        $container = static::getContainer();
        $this->serializer = $container->get(SerializerInterface::class);

        $weMovieRetrievalClassName = str_replace('Test', '', get_class($this));
        $weMovieRetrievalClassName = str_replace('s\\', '', $weMovieRetrievalClassName);

        $this->weMovieRetrieval = call_user_func([$weMovieRetrievalClassName, 'getInstance'], $this->httpClient, $this->serializer);
    }

}