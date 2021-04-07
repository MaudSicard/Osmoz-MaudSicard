<?php

namespace App\Controller\Api;

use App\Entity\Gender;
use App\Repository\GenderRepository;
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
 * API GenderController
 */
class GenderController extends AbstractController
{
    /**
     * Read genders order by created_at
     * @Route("/api/gender/read", name="api_gender_read", methods={"GET"})
     */
    public function read(GenderRepository $genderRepository): Response
    {
        $genderList = $genderRepository->findAllGenderByCreatedAt();
        return $this->json($genderList, 200, [], ['groups' => 'gender_read']);
    }

    /**
     * Read one gender by id
     * @Route("/api/gender/read/{id<\d+>}", name="api_gender_read_id", methods={"GET"})
     */
    public function readById(Gender $gender = null): Response
    {
        if ($gender === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Genre non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($gender, 200, [],
        ['groups' => 'gender_read']);
    }


    /**
     * Read books by gender and by id
     * @Route("/api/gender/read/book/departement", name="api_gender_read_book_departement", methods={"POST"})
     */
    public function readBooksByIdAndDepartement(Request $request, GenderRepository $genderRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $gender = $genderRepository->findBooksGenderByDepartement($id, $departement);
        
        return $this->json($gender, 200, [],
        ['groups' => 'gender_read']);
    }

    /**
     * Read musics by gender and by id
     * @Route("/api/gender/read/music/departement", name="api_gender_read_music_departement", methods={"POST"})
     */
    public function readMusicsByIdAndDepartement(Request $request, GenderRepository $genderRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $gender = $genderRepository->findMusicsGenderByDepartement($id, $departement);
        
        return $this->json($gender, 200, [],
        ['groups' => 'gender_read']);
    }

    /**
     * Read movies by gender and by id
     * @Route("/api/gender/read/movie/departement", name="api_gender_read_movie_departement", methods={"POST"})
     */
    public function readMoviesByIdAndDepartement(Request $request, GenderRepository $genderRepository): Response
    {
        $jsonContent = $request->getContent();

        $json = json_decode($jsonContent);

        $id = $json->id;
        $departement = $json->departement;
      
        $gender = $genderRepository->findMoviesGenderByDepartement($id, $departement);
        
        return $this->json($gender, 200, [],
        ['groups' => 'gender_read']);
    }
}
