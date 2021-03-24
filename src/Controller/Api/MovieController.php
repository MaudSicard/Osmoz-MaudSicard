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
     * @Route("/api/movies/{id<\d+>}", name="api_movies_read_item", methods="GET")
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
     * Delete movie
     * 
     * @Route("/api/movies/{id<\d+>}", name="api_movies_delete", methods="DELETE")
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






