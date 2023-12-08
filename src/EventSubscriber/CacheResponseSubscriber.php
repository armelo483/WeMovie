<?php

namespace App\EventSubscriber;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Cache\CacheInterface;

// On isole la logique de mise en cache ici de manière REACTIVE pour
// plus de souplesse et de flexibilité du code
class CacheResponseSubscriber implements EventSubscriberInterface
{
    public function __construct(private CacheItemPoolInterface $cachePool, private int $cacheItemTimeExp){
    }

    /**
     * @throws InvalidArgumentException
     */
    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $request = $event->getRequest();
        $cacheKey = $this->generateCacheKey($request);
        $cacheItem = $this->cachePool->getItem($cacheKey);

        // SI le cache est présent et est valide on modifie la réponse envoyée en l'incorporant
        if ($cacheItem->isHit()) { dd('gg');
            $cachedContent = $cacheItem->get();
            $response = new Response($cachedContent, Response::HTTP_OK, $response->headers->all());
            $event->setResponse($response);
        } else {
            $cacheItem->set($response->getContent());
//            dd('t', $response->getContent());
            $cacheItem->expiresAfter($this->cacheItemTimeExp);
            $this->cachePool->save($cacheItem);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    private function generateCacheKey(Request $request): string
    {
        return md5($request->getUri());
    }
}
