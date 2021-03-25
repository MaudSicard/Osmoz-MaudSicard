<?php

namespace App\Controller\Admin;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    /**
     * List Movies
     *
     * @Route("/back/movies/read", name="back_movie_read", methods={"GET"})
     */
    public function read(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAllOrderedByCreatedAT();

        // dump($movies);

        return $this->render('admin/movie/read.html.twig', [
            'movies' => $movies,
        ]);
    }

}
