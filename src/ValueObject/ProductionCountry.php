<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use phpDocumentor\Reflection\Types\Parent_;

#[Embeddable]
final class ProductionCountry extends WeMoviesValueObject
{

    #[Column(type: "string")]
    private ?string $countryName ;


    public function __construct(?string $isoValue, ?string $countryName)
    {
        Parent::__construct($isoValue);
        $this->countryName = $countryName;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

}