<?php

namespace App\Controller\Api;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * API TypeController
 */
class TypeController extends AbstractController
{
    /**
     * Read types order by created_at
     * @Route("/api/type/read", name="api_type_read", methods={"GET"})
     */
    public function read(TypeRepository $typeRepository): Response
    {
        $typeList = $typeRepository->findAllTypeByCreatedAt();
        return $this->json($typeList, 200, [], ['groups' => 'type_read']);
    }

    /**
     * Read one type by id
     * @Route("/api/type/read/{id<\d+>}", name="api_type_read_id", methods={"GET"})
     */
    public function readById(Type $type = null): Response
    {
        if ($type === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Type non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($type, 200, [],
        ['groups' => 'type_read']);
    }

    /**
     * Read books by type and by id
     * @Route("/api/type/read/book/departement", name="api_type_read_book_departement", methods={"POST"})
     */
    public function readBooksByIdAndDepartement(Request $request, TypeRepository $typeRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $type = $typeRepository->findBooksTypeByDepartement($id, $departement);
        
        return $this->json($type, 200, [],
        ['groups' => 'type_read']);
    }

    /**
     * Read musics by type and by id
     * @Route("/api/type/read/music/departement", name="api_type_read_music_departement", methods={"POST"})
     */
    public function readMusicsByIdAndDepartement(Request $request, TypeRepository $typeRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $type = $typeRepository->findMusicsTypeByDepartement($id, $departement);
        
        return $this->json($type, 200, [],
        ['groups' => 'type_read']);
    }

    /**
     * Read movies by type and by id
     * @Route("/api/type/read/movie/departement", name="api_type_read_movie_departement", methods={"POST"})
     */
    public function readMoviesByIdAndDepartement(Request $request, TypeRepository $typeRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $type = $typeRepository->findMoviesTypeByDepartement($id, $departement);
        
        return $this->json($type, 200, [],
        ['groups' => 'type_read']);
    }
}
