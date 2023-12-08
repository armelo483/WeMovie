<?php

namespace App\Controller;

use App\Form\GenreType;
use App\Message\CacheMessage;
use App\WeMovieRetrieval\BestRatedMovieStrategy;
use App\WeMovieRetrieval\GenreRetrievalStrategy;
use App\WeMovieRetrieval\MoviesByGenreStrategy;
use App\Service\WeMovieAPIInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeMovieHomeController extends WeMovieBaseController
{
    /**
     * @throws InvalidArgumentException
     */
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $genreRetrievalStrategy = GenreRetrievalStrategy::getInstance($this->weMovieApiClient, $this->serializer);
        $this->weMovieApi->setWeMovieRetrievalStrategy($genreRetrievalStrategy);
        $genres = $this->weMovieApi->get();

        $idCache = 'best_movie';


        $bestMovie = $this->cachePool->get($idCache, function (CacheItem $item) {
            dd($item, $this->cachePool);
            // La fonction anonyme sera appelée si les données ne sont pas présentes dans le cache

            $bestRatedMovieStrategy = BestRatedMovieStrategy::getInstance($this->weMovieApiClient, $this->serializer);
            $this->weMovieApi->setWeMovieRetrievalStrategy($bestRatedMovieStrategy);

            // Mettez en cache la valeur et spécifiez sa durée de validité (par exemple, 30 minutes)
            $item->expiresAfter(1800); // 30 minutes en secondes
            return $this->weMovieApi->get();
        });


        //$this->messageBus->dispatch(new CacheMessage('best_movie', [$bestMovie]));

        $genreForm = $this->createForm(GenreType::class, $genres);


        return $this->render('wemovie/movie_home.html.twig', [
            'genres' => $genres,
            'genre_form' => $genreForm->createView(),
            'best_movie' => $bestMovie
        ]);
    }
}
