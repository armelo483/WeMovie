<?php

namespace App\Message;

use App\Entity\WeMoviesEntity;

class CacheMessage
{
    /**
     * @var string
     */
    private string $key;

    /**
     * @var WeMoviesEntity[]
     */
    private array $value;

    /**
     * @param string $key
     * @param WeMoviesEntity[] $value
     */
    public function __construct(string $key, array $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return WeMoviesEntity[]
     */
    public function getValue(): array
    {
        return $this->value;
    }
}