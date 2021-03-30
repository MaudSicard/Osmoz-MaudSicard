<?php

namespace App\Controller\Api;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\StringType;
use PhpParser\Node\Expr\Cast\String_;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonDecode;

/**
 * API BookController
 */
class BookController extends AbstractController
{
    /**
     * Read 10 books order by created_at
     * @Route("/api/book/read", name="api_book_read", methods={"GET"})
     */
    public function read(BookRepository $bookRepository): Response
    {
        $bookList = $bookRepository->findAllByCreatedAt();
        return $this->json($bookList, 200, ['Access-Control-Allow-Origin' =>'*'], ['groups' => 'book_read']);
    }

    /**
     * Read one book by id
     * @Route("/api/book/read/{id<\d+>}", name="api_book_read_id", methods={"GET"})
     */
    public function readById(Book $book = null): Response
    {
        if ($book === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Livre non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($book, 200, [],
        ['groups' => 'book_read']);
    }

    /**
     * Read one book by keyWord
     * @Route("/api/book/keyWord", name="api_book_read_keyWord", methods={"GET"})
     */
    public function readByKeyWord(BookRepository $bookRepository, Request $request, SerializerInterface $serializer): Response
    {
        $jsonContent = $request->getContent();

        $keyWord = json_decode($jsonContent);

        $book = $bookRepository->findOneBookByKeyWord($keyWord);

        return $this->json($book, 200, [],
        ['groups' => 'book_read']);
    }


    /**
     * Add a book in the data base
     * @Route("/api/book/create", name="api_book_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $jsonContent = $request->getContent();

        $book = $serializer->deserialize($jsonContent, Book::class, 'json');

        $errors = $validator->validate($book);

        if (count($errors) > 0) {

            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->setCreatedAt(new \DateTime());
        $entityManager->persist($book);
        $entityManager->flush();

        
        return $this->redirectToRoute(
            'api_book_read_id',
            ['id' => $book->getId()],
          
            Response::HTTP_CREATED
        );
    }

    /**
     * Update a book
     * 
     * @Route("/api/book/put/{id<\d+>}", name="api_book_put", methods={"PUT"})
     * @Route("/api/book/patch/{id<\d+>}", name="api_book_patch", methods={"PATCH"})
     */
    public function putAndPatch(Book $book = null, EntityManagerInterface $em, SerializerInterface $serializer, Request $request, ValidatorInterface $validator)
    {
        if ($book === null) {
            
            return $this->json(['error' => 'Livre non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        $jsonContent = $request->getContent();

        $serializer->deserialize(
            $jsonContent,
            Book::class,
            'json',
            
            [AbstractNormalizer::OBJECT_TO_POPULATE => $book]
        );

        $errors = $validator->validate($book);
        
        if (count($errors) > 0) {
           
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->flush();

        return $this->json(['message' => 'Livre modifié.'], Response::HTTP_OK);
    }

    /**
     * Delete a book
     * 
     * @Route("/api/book/delete/{id<\d+>}", name="api_book_delete", methods="DELETE")
     */
    public function delete(Book $book = null, EntityManagerInterface $entityManager)
    {
        if ($book === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Livre non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->json(
            ['message' => 'Le livre a été supprimé'],
            Response::HTTP_OK);
    }
}
