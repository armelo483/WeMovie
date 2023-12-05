<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\Column;

#[MappedSuperclass]
abstract class WeMoviesValueObject
{
    #[Column(type: "string")]
    protected  ?string $isoValue ;

    public function __construct(?string $isoValue)
    {
        $this->isoValue = $isoValue;
    }


    /**
     * @return string
     */
    public function getIsoValue(): string
    {
        return $this->isoValue;
    }


}