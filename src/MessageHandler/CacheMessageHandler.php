<?php

namespace App\MessageHandler;

use App\Message\CacheMessage;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CacheMessageHandler
{
    //public function __construct(private RedisAdapter $cache, private int $cacheItemTimeExp){}
    public function __construct(private int $cacheItemTimeExp){}

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(CacheMessage $message): void
    {
        $key = $message->getKey();
        $value = $message->getValue();

        dd($message, $this->cacheItemTimeExp);
        $cacheItem = $this->cache->getItem($key);
        $cacheItem->set($value);
        $cacheItem->expiresAfter($this->cacheItemTimeExp);

       // $this->cache->save($cacheItem);
    }

}