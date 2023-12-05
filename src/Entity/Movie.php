<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use App\ValueObject\ProductionCountry;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Context;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use DateTime;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Movie extends WeMoviesEntity
{
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $youtubeVideoId = null;

    #[ORM\Column]
    private ?float $voteAverage = null;

    #[ORM\Column]
    private ?int $voteCount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable:true)]
    private ?DateTimeInterface $releaseDate;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $posterPath = '';

    #[ORM\Column(length: 255)]
    private ?string $overView = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'movies')]
    private Collection $genres;

    #[ORM\ManyToMany(targetEntity: ProductionCompany::class, inversedBy: 'movies')]
    private Collection $productionCompanies;

  /*#[ORM\Embedded(ProductionCountry::class)]
    private Collection  $productionCountries;*/

    #[ORM\Column(type: "json")]
    #[MaxDepth(3)]
    private array $productionCountries = [];


    /*
     #[ORM\Embedded(SpokenLanguages::class)]
     private Collection $spokenLanguages;*/

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->productionCompanies = new ArrayCollection();
        $this->releaseDate = new DateTime();
        //$this->spokenLanguages = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): static
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): static
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getReleaseDate(): ? DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTimeInterface|null $releaseDate
     * @return $this
     */
    public function setReleaseDate(?DateTimeInterface $releaseDate): self
    {

        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    /**
     * @param string|null $posterPath
     * @return $this
     */
    public function setPosterPath(?string $posterPath = ''): static
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getOverView(): ?string
    {
        return $this->overView;
    }

    public function setOverView(string $overView): static
    {
        $this->overView = $overView;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, ProductionCompany>
     */
    public function getProductionCompanies(): Collection
    {
        return $this->productionCompanies;
    }

    /**
     * @return ProductionCountry[]
     */
    public function getProductionCountries(): array
    {
        return $this->productionCountries;
    }



    /*
    public function getProductionCountries(): Collection
    {
        return $this->productionCountries;
    }

    public function setProductionCountries(Collection $productionCountries): static
    {
        $this->productionCountries = $productionCountries;

        return $this;
    }

    public function getSpokenLanguages(): Collection
    {
        return $this->spokenLanguages;
    }

    public function setSpokenLanguages(Collection $spokenLanguages): static
    {
        $this->spokenLanguages = $spokenLanguages;

        return $this;
    }
*/
    public function addProductionCompany(ProductionCompany $productionCompany): static
    {
        if (!$this->productionCompanies->contains($productionCompany)) {
            $this->productionCompanies->add($productionCompany);
        }

        return $this;
    }

    public function removeProductionCompany(ProductionCompany $productionCompany): static
    {
        $this->productionCompanies->removeElement($productionCompany);

        return $this;
    }

    /**
     * @param ProductionCountry[] $productionCountries
     * @return $this
     */
    public function addProductionCountries(array $productionCountries): static
    {
        foreach ($productionCountries as $productionCountry) {
            if (!$this->hasProductionCountry($productionCountry)) {
                $this->productionCountries[] = [
                    'name' => $productionCountry->getCountryName(),
                    // Adjust the array structure based on your ProductionCountry class properties
                ];
            }
        }

        return $this;
    }

    /**
     * @param ProductionCountry[] $productionCountries
     * @return $this
     */
    public function removeProductionCountries(array $productionCountries): static
    {
        foreach ($productionCountries as $productionCountry) {
            unset($productionCountry);
        }

        return $this;
    }

    /**
     * @param ProductionCountry $productionCountry
     * @return bool
     */
    private function hasProductionCountry(ProductionCountry $productionCountry): bool
    {
        foreach ($this->productionCountries as $existingProductionCountry) {
            if ($existingProductionCountry['countryName'] === $productionCountry->getCountryName()) {
                return true;
            }
        }

        return false;
    }

    public function getYoutubeVideoId(): ?string
    {
        return $this->youtubeVideoId;
    }

    public function setYoutubeVideoId(?string $youtubeVideoId): void
    {
        $this->youtubeVideoId = $youtubeVideoId;
    }



}
