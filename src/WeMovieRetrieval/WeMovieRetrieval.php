<?php

namespace App\WeMovieRetrieval;

use Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

// On s'assure que chaque strategy est produite une seule fois en memoire par session user
abstract class WeMovieRetrieval
{
    protected  OptionsResolver $resolver;
    private static array $instances = [];
    private  const ERROR = 'Cannot unserialize a singleton';
    protected const JSON_FORMAT = 'json';
    protected const INT_FORMAT = 'int';
    protected const GET_METHOD = 'GET';


    // Juste pour initialiser les params
    private function __construct(
        protected HttpClientInterface $httpClient,
        protected SerializerInterface $serializer
    ) {
        $this->resolver = new OptionsResolver();
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception(self::ERROR);
    }

    public static function getInstance(HttpClientInterface $httpClient, SerializerInterface $serializer): static
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($httpClient, $serializer);
        }

        return self::$instances[$cls];
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function getArrayFromJson(string $relativeUrl): array
    {
        return json_decode($this->httpClient->request(self::GET_METHOD, $relativeUrl)?->getContent(), true);
    }

    protected function configureOptions(string $propertyName): void
    {
        $this->resolver->setRequired($propertyName);
    }
}