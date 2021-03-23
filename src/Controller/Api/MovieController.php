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
    public function read(MovieRepository $movieRepository, SerializerInterface $serializer): Response
    {
        $movies = $movieRepository->findAllOrderedByCreatedAtAsc();

        return $this->json($movies, 200, [], ['groups' => 'movies_read']);
    }

        /**
     * Read one movie
     * 
     * @Route("/api/movies/{id<\d+>}", name="api_movies_read_item", methods="GET")
     */
    public function readItem(Movie $movie = null): Response
    {
        // 404 ?
        if ($movie === null) {

            // Optionnel, message pour le front
            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Film non trouvé.',
            ];

            // On défini un message custom et un status code HTTP 404
            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        // @todo Tenter d'utiliser la requête custom
        // de jointure sur castings et persons

        // Le 4ème argument représente le "contexte"
        // qui sera transmis au Serializer
        return $this->json($movie, 200, [], ['groups' => [
                'movies_read',
            ]
        ]);
    }


}

