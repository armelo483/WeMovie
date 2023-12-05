<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use App\ValueObject\ProductionCountry;
use App\ValueObject\SpokenLanguages;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class MovieCopy extends WeMoviesEntity
{
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?float $voteAverage = null;

    #[ORM\Column]
    private ?int $voteCount = null;

    #[ORM\Column]
    private ?bool $hasVideo = null;

    #[ORM\Column(length: 255)]
    private ?string $tagLine = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $runtime = null;

    #[ORM\Column]
    private ?int $revenue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $posterPath = null;

    #[ORM\Column]
    private ?float $popularity = null;

    #[ORM\Column(length: 255)]
    private ?string $overView = null;

    #[ORM\Column(length: 255)]
    private ?string $originalTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $originalLanguage = null;

    #[ORM\Column]
    private ?int $imdbId = null;

    #[ORM\Column(length: 255)]
    private ?string $homePage = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isInCollection = null;

    #[ORM\Column(length: 255)]
    private ?string $backdropPath = null;

    #[ORM\Column]
    private ?bool $isAdultMovie = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'movies')]
    private Collection $genres;

    #[ORM\ManyToMany(targetEntity: ProductionCompany::class, inversedBy: 'movies')]
    private Collection $productionCompanies;

    #[ORM\Embedded(ProductionCountry::class)]
    private Collection $productionCountries;

    #[ORM\Embedded(SpokenLanguages::class)]
    private Collection $spokenLanguages;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->productionCompanies = new ArrayCollection();
        $this->productionCountries = new ArrayCollection();
        $this->spokenLanguages = new ArrayCollection();
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

    public function isHasVideo(): ?bool
    {
        return $this->hasVideo;
    }

    public function setHasVideo(bool $hasVideo): static
    {
        $this->hasVideo = $hasVideo;

        return $this;
    }

    public function getTagLine(): ?string
    {
        return $this->tagLine;
    }

    public function setTagLine(string $tagLine): static
    {
        $this->tagLine = $tagLine;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): static
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(string $posterPath): static
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): static
    {
        $this->popularity = $popularity;

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

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): static
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(string $originalLanguage): static
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    public function getImdbId(): ?int
    {
        return $this->imdbId;
    }

    public function setImdbId(int $imdbId): static
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    public function getHomePage(): ?string
    {
        return $this->homePage;
    }

    public function setHomePage(string $homePage): static
    {
        $this->homePage = $homePage;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function isIsInCollection(): ?bool
    {
        return $this->isInCollection;
    }

    public function setIsInCollection(?bool $isInCollection): static
    {
        $this->isInCollection = $isInCollection;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }

    public function setBackdropPath(string $backdropPath): static
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    public function isIsAdultMovie(): ?bool
    {
        return $this->isAdultMovie;
    }

    public function setIsAdultMovie(bool $isAdultMovie): static
    {
        $this->isAdultMovie = $isAdultMovie;

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

    public function addProductionCountry(ProductionCountry $productionCountry): static
    {
        if (!$this->productionCountries->contains($productionCountry)) {
            $this->productionCountries->add($productionCountry);
        }

        return $this;
    }

    public function removeProductionCountry(ProductionCountry $productionCountry): static
    {
        $this->productionCountries->removeElement($productionCountry);

        return $this;
    }

}
