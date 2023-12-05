<?php

namespace App\Controller;

use App\Form\GenreType;
use App\WeMovieRetrieval\BestRatedMovieStrategy;
use App\WeMovieRetrieval\GenreRetrievalStrategy;
use App\WeMovieRetrieval\MoviesByGenreStrategy;
use App\Service\WeMovieAPIInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeMovieHomeController extends WeMovieBaseController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $genreRetrievalStrategy = GenreRetrievalStrategy::getInstance($this->weMovieApiClient, $this->serializer);
        $this->weMovieApi->setWeMovieRetrievalStrategy($genreRetrievalStrategy);
        $genres = $this->weMovieApi->get();

        $bestRatedMovieStrategy = BestRatedMovieStrategy::getInstance($this->weMovieApiClient, $this->serializer);

        $this->weMovieApi->setWeMovieRetrievalStrategy($bestRatedMovieStrategy);

        $bestMovie = $this->weMovieApi->get();

        $genreForm = $this->createForm(GenreType::class, $genres);

        return $this->render('wemovie/movie_home.html.twig', [
            'genres' => $genres,
            'genre_form' => $genreForm->createView(),
            'best_movie' => $bestMovie
        ]);
    }
}
