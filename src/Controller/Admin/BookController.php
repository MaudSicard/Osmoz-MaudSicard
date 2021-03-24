<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Admin BookController
 */
class BookController extends AbstractController
{
  /**
     * 
     *
     * @Route("/admin/book/read", name="admin_book_read", methods={"GET"})
     */
    public function read(BookRepository $bookRepository): Response
    {
       $books = $bookRepository->findAll();

        var_dump($books);
        return $this->render('admin/book_read.html.twig', [
            'book' => $books,
        ]);
    }

    /**
     * Ajout film
     *
     * @Route("back/movie/add", name="back_movie_add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $entityManager, MySlugger $slugger): Response
    {
        // L'entité à créer
        $movie = new Movie();

        // Le formulaire associé à l'entité
        $form = $this->createForm(MovieType::class, $movie);

        // Inspection et prise en charge de la requête par le formulaire
        $form->handleRequest($request);

        // Form soumis et valide ?
        if ($form->isSubmitted() && $form->isValid()) {

            // On slugifie le titre
            // => cela a été déplacé dans le Listener
            
            // On sauvegarde le film
            $entityManager->persist($movie);
            $entityManager->flush();

            // On redirige vers la liste côté back
            return $this->redirectToRoute('back_movie_browse');
        }

        // Rendu/affichage du form
        return $this->render('back/movie/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/back/movie/edit/{id}", name="back_movie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Movie $movie, MySlugger $slugger): Response
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Slug
            // /!\ Attention au SEO
            // dans la vraie on doit créer une redirection 302
            // de l'ancienne URL vers la nouvelle
            
            // => cela a été déplacé dans le Listener

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_movie_browse');
        }

        return $this->render('back/movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime une film (méthode HTTP DELETE !)
     * 
     * @Route("/back/movie/delete/{id<\d+>}", name="back_movie_delete", methods={"DELETE"})
     */
    public function delete(Movie $movie = null, Request $request, EntityManagerInterface $entityManager)
    {
        // 404 ?
        if ($movie === null) {
            throw $this->createNotFoundException('Film non trouvé.');
        }

        // @see https://symfony.com/doc/current/security/csrf.html#generating-and-checking-csrf-tokens-manually
        // On réupère le nom du token qu'on a déposé dans le form
        $submittedToken = $request->request->get('token');

        // 'delete-movie' is the same value used in the template to generate the token
        if (! $this->isCsrfTokenValid('delete-movie', $submittedToken)) {
            // On jette une 403
            throw $this->createAccessDeniedException('Are you token to me !??!??');
        }

        // Sinon on supprime
        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->redirectToRoute('back_movie_browse');
    }
}