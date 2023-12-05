<?php

namespace App\Controller;

use App\Controller\WeMovieBaseController;
use App\WeMovieRetrieval\MovieDetailStrategy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieDetailController extends WeMovieBaseController
{
    #[Route('/movie-detail/{movieId}', name: 'app_movie_detail')]
    public function movieDetail(int $movieId, Request $request): Response
    {
        $options['movie_id'] = $movieId ;
        $movieDetailStrategy = MovieDetailStrategy::getInstance($this->weMovieApiClient, $this->serializer);
        $this->weMovieApi->setWeMovieRetrievalStrategy($movieDetailStrategy);
        $movieDetail = $this->weMovieApi->get($options);

        if($request->isXmlHttpRequest()) {
            return $this->json($movieDetail);
        }

        return $this->render('wemovie/movie_detail.html.twig', [
            'movie' => $movieDetail
        ]);
    }

}