<?php

namespace App\Adapter;

interface WeMovieAPIAdapterInterface
{

    /**
     * @param string $jsonMovies
     * @return string
     */
    public function adaptAPIMoviesJson(string $jsonMovies): string;


    /**
     * @param string $jsonGenres
     * @return string
     */
    public function adaptAPIGenresJson(string $jsonGenres): string;

}