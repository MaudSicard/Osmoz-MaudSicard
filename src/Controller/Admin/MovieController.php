<?php

namespace App\Controller\Admin;

use MovieType;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Delete Movies
     * 
     * @Route("/back/movie/delete/{id<\d+>}", name="back_movie_delete", methods={"DELETE"})
     */
    public function delete(Movie $movie = null, Request $request, EntityManagerInterface $entityManager)
    {
        if ($movie === null) {
            throw $this->createNotFoundException('Film non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-movie', $submittedToken)) {
            
            throw $this->createAccessDeniedException('Are you token to me !??!??');
        }

        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->redirectToRoute('back_movie_read');
    }
}



