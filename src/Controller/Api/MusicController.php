<?php

namespace App\Controller\Api;

use App\Entity\Music;
use App\Repository\MusicRepository;
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
 * API MusicController
 */
class MusicController extends AbstractController
{
    /**
     * Read 10 album of music order by created_at
     * @Route("/api/music/read", name="api_music_read", methods={"GET"})
     */
    public function read(musicRepository $musicRepository): Response
    {
        $musicList = $musicRepository->findAllByCreatedAt();
        return $this->json($musicList, 200, ['Access-Control-Allow-Origin' =>'*'], ['groups' => 'music_read']);
    }

    /**
     * Read one music by id
     * @Route("/api/music/read/{id<\d+>}", name="api_music_read_id", methods={"GET"})
     */
    public function readById(Music $music = null): Response
    {
        if ($music === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Livre non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($music, 200, ['Access-Control-Allow-Origin' =>'*'],
        ['groups' => 'music_read']);
    }

    /**
     *
     * @Route("/api/music/create", name="api_music_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $jsonContent = $request->getContent();

        $music = $serializer->deserialize($jsonContent, Music::class, 'json');

        $errors = $validator->validate($music);

        if (count($errors) > 0) {

            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($music);
        $entityManager->flush();

        
        return $this->redirectToRoute(
            'api_music_read_id',
            ['id' => $music->getId()],
          
            Response::HTTP_CREATED
        );
    }

    /**
   
     * @Route("/api/music/put/{id<\d+>}", name="api_music_put", methods={"PUT"})
     * @Route("/api/music/patch/{id<\d+>}", name="api_music_patch", methods={"PATCH"})
     */
    public function putAndPatch(Music $music = null, EntityManagerInterface $em, SerializerInterface $serializer, Request $request, ValidatorInterface $validator)
    {
        if ($music === null) {
            
            return $this->json(['error' => 'Musique non trouvée.'], Response::HTTP_NOT_FOUND);
        }

        // Notre JSON qui se trouve dans le body
        $jsonContent = $request->getContent();

        $serializer->deserialize(
            $jsonContent,
            Music::class,
            'json',
            
            [AbstractNormalizer::OBJECT_TO_POPULATE => $music]
        );

        $errors = $validator->validate($music);
        
        if (count($errors) > 0) {
           
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->flush();

        return $this->json(['message' => 'La musique a été modifiée'], Response::HTTP_OK);
    }

    /**
     * 
     * @Route("/api/music/delete/{id<\d+>}", name="api_music_delete", methods="DELETE")
     */
    public function delete(Music $music = null, EntityManagerInterface $entityManager)
    {
        if ($music === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Livre non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($music);
        $entityManager->flush();

        return $this->json(
            ['message' => 'La musique a été supprimé'],
            Response::HTTP_OK);
    }
}
