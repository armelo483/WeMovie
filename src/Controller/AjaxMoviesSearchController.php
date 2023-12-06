<?php

namespace App\Controller;

use App\WeMovieRetrieval\MoviesByGenreStrategy;
use App\WeMovieRetrieval\MoviesSearchStrategy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxMoviesSearchController extends WeMovieBaseController
{
    #[Route('/search/{search_value}', name: 'app_search_movie')]
    public function genre(Request $request): JsonResponse
    {

        $searchValue = $request->get('search_value');
        $options['search_value'] = htmlspecialchars(trim($searchValue)) ;

        $moviesSearchStrategy = MoviesSearchStrategy::getInstance($this->weMovieApiClient, $this->serializer);
        $this->weMovieApi->setWeMovieRetrievalStrategy($moviesSearchStrategy);
        $movies = $this->weMovieApi->get($options);

        if($request->isXmlHttpRequest()) {

            $searchValue = $request->get('search_value');
            $options['search_value'] = htmlspecialchars(trim($searchValue)) ;
            $moviesSearchStrategy = MoviesSearchStrategy::getInstance($this->weMovieApiClient, $this->serializer);
            $this->weMovieApi->setWeMovieRetrievalStrategy($moviesSearchStrategy);
            $movies = $this->weMovieApi->get($options);

        }

        return $this->json($movies);

    }


}