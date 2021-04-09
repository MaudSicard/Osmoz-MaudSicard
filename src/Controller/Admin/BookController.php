<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Admin BookController
 */
class BookController extends AbstractController
{
  /**
     * Read all books
     * 
     * @Route("/admin/book/read", name="admin_book_read", methods={"GET"})
     */
    public function read(BookRepository $bookRepository): Response
    {
       $books = $bookRepository->findAllBookByUserType();

        return $this->render('admin/book/book_read.html.twig', [
            'books' => $books,
        ]);
    }


    /**
     * Update a book
     * 
     * @Route("/admin/book/update/{id<\d+>}", name="admin_book_update", methods={"GET","POST"})
     */
    public function update (Request $request, Book $book)
    {
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Livre modifié');

            return $this->redirectToRoute('admin_book_read');
        }

        return $this->render('admin/book/book_edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a book
     * 
     * @Route("/admin/book/delete/{id<\d+>}", name="admin_book_delete", methods={"DELETE"})
     */
    public function delete(Book $book = null, Request $request, EntityManagerInterface $entityManager)
    {
        if ($book === null) {
            throw $this->createNotFoundException('livre non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-book', $submittedToken)) {
            
            throw $this->createAccessDeniedException('non autorisé');
        }

        $entityManager->remove($book);
        $entityManager->flush();

        $this->addFlash('success', 'Livre supprimé');

        return $this->redirectToRoute('admin_book_read');
    }

}