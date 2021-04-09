<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * Read all users
     * 
     * @Route("/api/users/read", name="api_users_read", methods="GET")
     */
    public function read(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->json($users, 200, [], ['groups' => [
            'users_read'
        ]
        ]);
    }

    /**
     * Read one user
     * 
     * @Route("/api/users/{id<\d+>}", name="api_users_read_item", methods="GET")
     */
    public function readItem(User $user = null, UserRepository $userRepository): Response
    {

        if ($user === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'User non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($user, 200, [], ['groups' => [
            'users_read',
        ]
    ]);
    }

    /**
     * Read users by departement
     * 
     * @Route("/api/users/read/departement/{departement}", name="api_users_read_departement", methods="GET")
     */
    public function readByDepartement($departement, User $user = null, UserRepository $userRepository): Response
    {

        $users = $userRepository->findUsersByDepartement($departement);

        if ($user === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'User non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($users, 200, [], ['groups' => [
            'users_read',
        ]
    ]);
    }

       /**
     * Read users by email
     * 
     * @Route("/api/users/read/email/{email}", name="api_users_read_email", methods="GET")
     */
    public function readByEmail($email, User $user = null, UserRepository $userRepository): Response
    {

        $user = $userRepository->findUserByEmail($email);

        if ($user === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'User non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json($user, 200, [], ['groups' => [
            'users_read',
        ]
    ]);
    }


    /** Create user
    * 
    * @Route("/api/users/create", name="api_users_create", methods="POST")
    */
   public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder)
   {      

       $jsonContent = $request->getContent();

       $user = $serializer->deserialize($jsonContent, User::class, 'json');
       
       $hashedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
      
       $user->setPassword($hashedPassword);

       $errors = $validator->validate($user);

       if (count($errors) > 0) {
   
           return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
       }
       
       $entityManager->persist($user);
       $entityManager->flush();

       return $this->redirectToRoute(
           'api_users_read_item',
           ['id' => $user->getId()],
           Response::HTTP_CREATED
       );
   }

   /**
     * Update a User (PUT et PATCH)
     *
     * @Route("/api/users/put/{id<\d+>}", name="api_users_put", methods={"PUT"})
     * @Route("/api/users/patch/{id<\d+>}", name="api_users_patch", methods={"PATCH"})
     */
    public function putAndPatch(User $user = null, EntityManagerInterface $entityManager, SerializerInterface $serializer, Request $request, ValidatorInterface $validator)
    {
        if ($user === null) {
            return $this->json(['error' => 'Utilisateur non trouvé.'], Response::HTTP_NOT_FOUND);
        }
        $jsonContent = $request->getContent();
        $serializer->deserialize(
            $jsonContent,
            User::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $user]
        );
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $entityManager->flush();
        return $this->json(['message' => 'Utilisateur modifié.'], Response::HTTP_OK);
    }

    /**
     * Delete movie
     * 
     * @Route("/api/users/{id<\d+>}", name="api_users_delete", methods="DELETE")
     */
    public function delete(User $user = null, EntityManagerInterface $entityManager)
    {

        if ($user === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'User non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json(
            ['message' => 'Le user ' . $user->getEmail() . ' a été supprimé !'],
            Response::HTTP_OK);
    }

}