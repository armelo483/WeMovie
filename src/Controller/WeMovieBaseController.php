<?php

namespace App\Controller;

use App\Service\WeMovieAPIInterface;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract  class WeMovieBaseController extends AbstractController
{
    public function __construct(
        protected WeMovieAPIInterface $weMovieApi,
        protected HttpClientInterface $weMovieApiClient,
        protected SerializerInterface $serializer,
        protected MessageBusInterface $messageBus,
        protected CacheInterface $cachePool
    ){}

}