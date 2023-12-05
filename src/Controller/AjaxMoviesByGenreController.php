<?php

namespace App\Controller;

use App\Controller\WeMovieBaseController;
use App\DTO\SearchParam;
use App\WeMovieRetrieval\GenreRetrievalStrategy;
use App\WeMovieRetrieval\MoviesByGenreStrategy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;

class AjaxMoviesByGenreController extends WeMovieBaseController
{
    #[Route('/by-genre/{genreId}', name: 'app_by_genre')]
    public function genre(int $genreId, Request $request): JsonResponse
    {
        $movies = [];
        if($request->isXmlHttpRequest()) {

            $options['genre_id'] = $genreId ;
            $moviesByGenreStrategy = MoviesByGenreStrategy::getInstance($this->weMovieApiClient, $this->serializer);
            $this->weMovieApi->setWeMovieRetrievalStrategy($moviesByGenreStrategy);
            $movies = $this->weMovieApi->get($options);

        }

        return $this->json($movies);

    }


}