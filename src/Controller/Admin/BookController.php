<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;

/**
 * Admin BookController
 */
class BookController extends AbstractController
{
  /**
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
     * 
     * @Route("/admin/book/delete/{id<\d+>}", name="admin_book_delete", methods={"GET"})
     */
    public function delete(Book $book = null, EntityManagerInterface $entityManager)
    {
        if ($book === null) {
            throw $this->createNotFoundException('livre non trouvé.');
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('admin_book_read');
    }


    /**
     * @Route("/admin/book/update/{id<\d+>}", name="admin_book_update", methods={"GET"})
     */
    public function update (Request $request, BookRepository $bookRepository)
    {
       
    }


}