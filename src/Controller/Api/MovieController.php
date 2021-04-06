<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    /**
     * Read all movies
     * 
     * @Route("/api/movies/read", name="api_movies_read", methods="GET")
     */
    public function read(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAllOrderedByCreatedAtAsc();
        //dd($movies);

        return $this->json($movies, 200, ['Access-Control-Allow-Origin' =>'*'], ['groups' => [
            'movies_read',
        ]
        ]);
    }

    /**
     * Read one movie
     * 
     * @Route("/api/movies/read/{id<\d+>}", name="api_movies_read_item", methods="GET")
     */
    public function readItem(Movie $movie = null): Response
    {

        if ($movie === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Film non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($movie, 200, ['Access-Control-Allow-Origin' =>'*'], ['groups' => [
            'movies_read',
        ]
    ]);
    }

    /**
     * Read movies by keyword
     * @Route("/api/movies/keyword", name="api_movies_keyword", methods={"POST"})
     */
    public function readByKeyword(MovieRepository $movieRepository, Request $request, SerializerInterface $serializer): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $keyword = $json->keyword;
        $departement = $json->departement;

        $movie = $movieRepository->findMoviesByKeyWord($keyword, $departement);

        return $this->json($movie, 200, [],
        ['groups' => 'movies_read']);
    }

    /**
     * Create movie
     * 
     * @Route("/api/movies/create", name="api_movies_create", methods="POST")
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {      

        $jsonContent = $request->getContent();
        // dd($jsonContent);

        $movie = $serializer->deserialize($jsonContent, Movie::class, 'json');
        // dd($movie);

        $errors = $validator->validate($movie);

        if (count($errors) > 0) {
    
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute(
            'api_movies_read_item',
            ['id' => $movie->getId()],
            Response::HTTP_CREATED
        );
    }

    /**
     * Edit movie (PUT et PATCH)
     * 
     * @Route("/api/movies/{id<\d+>}", name="api_movies_put", methods={"PUT"})
     * @Route("/api/movies/{id<\d+>}", name="api_movies_patch", methods={"PATCH"})
     */
    public function putAndPatch(Movie $movie = null, EntityManagerInterface $entityManager, SerializerInterface $serializer, Request $request, ValidatorInterface $validator)
    {

        if ($movie === null) {

            return $this->json(['error' => 'Film non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        $jsonContent = $request->getContent();

        $serializer->deserialize(
            $jsonContent,
            Movie::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $movie]
        );

        $errors = $validator->validate($movie);

        if (count($errors) > 0) {

            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json(['message' => 'Film modifié.'], Response::HTTP_OK);
    }

    /**
     * Delete movie
     * 
     * @Route("/api/movies/delete/{id<\d+>}", name="api_movies_delete", methods="DELETE")
     */
    public function delete(Movie $movie = null, EntityManagerInterface $entityManager)
    {

        if ($movie === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Film non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->json(
            ['message' => 'Le film ' . $movie->getName() . ' a été supprimé !'],
            Response::HTTP_OK);
    }
}






