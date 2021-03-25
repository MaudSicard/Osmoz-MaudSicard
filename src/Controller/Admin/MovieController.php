<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Entity\Gender;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use App\Repository\GenderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    /**
     * List Movies
     *
     * @Route("/back/movies/read", name="back_movie_read", methods={"GET"})
     */
    public function read(MovieRepository $movieRepository, GenderRepository $genderRepository): Response
    {

        $genders = $genderRepository->findAll();
        
        $movies = $movieRepository->findAllOrderedByCreatedAT();

        // dump($movies);

        return $this->render('admin/movie/read.html.twig', [
            'movies' => $movies,
            'genders' => $genders
        ]);
    }

    /**
     * @Route("/back/movie/edit/{id}", name="back_movie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Movie $movie): Response
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_movie_read');
        }

        return $this->render('admin/movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
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



