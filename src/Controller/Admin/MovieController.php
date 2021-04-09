<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Form\MovieType;
use Psr\Log\LoggerInterface;
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
     * @Route("/admin/movie/read", name="admin_movie_read", methods={"GET"})
     */
    public function read(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAllOrderedByCreatedAt();

        // dump($movies);

        return $this->render('admin/movie/movie_read.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * Edit Movie
     * 
     * @Route("/admin/movie/update/{id}", name="admin_movie_update", methods={"GET","POST"})
     */
    public function edit(Request $request, Movie $movie, LoggerInterface $logger ): Response
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Film modifié');
           
            return $this->redirectToRoute('admin_movie_read');
        }

        return $this->render('admin/movie/movie_edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete Movies
     * 
     * @Route("/admin/movie/delete/{id<\d+>}", name="admin_movie_delete", methods={"DELETE"})
     */
    public function delete(Movie $movie = null, Request $request, EntityManagerInterface $entityManager)
    {
        if ($movie === null) {
            throw $this->createNotFoundException('Film non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-movie', $submittedToken)) {
            
            throw $this->createAccessDeniedException('non autorisé');
        }

        $entityManager->remove($movie);
        $entityManager->flush();

        $this->addFlash('success', 'Film supprimé');


        return $this->redirectToRoute('admin_movie_read');
    }
}