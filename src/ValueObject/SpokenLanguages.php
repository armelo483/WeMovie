<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class SpokenLanguages extends WeMoviesValueObject
{
    #[Column(type: "string")]
    private  string $englishName ;


    #[Column(type: "string")]
    private  string $name ;

    /**
     * @param string $englishName
     * @param string $isoValue
     * @param string $name
     */
    public function __construct(string $englishName, string $isoValue, string $name)
    {
        $this->englishName = $englishName;
        $this->isoValue = $isoValue;
        $this->name = $name;
    }

    public function getEnglishName(): string
    {
        return $this->englishName;
    }

    public function getName(): string
    {
        return $this->name;
    }

}