<?php

namespace App\Controller\Api;

use App\Entity\Mail;
use App\Repository\MailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    /**
     * Read mails by id
     *
     * @Route("/api/mail/read/{id<\d+>}", name="api_mail_read_id", methods={"GET"})
     */
    public function readById(Mail $mail = null): Response
    {
        if ($mail === null) {
            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'message non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        return $this->json(
            $mail,
            200,
            ['Access-Control-Allow-Origin' =>'*'],
            ['groups' => 'mails_read']
        );
    }

    /**
     * Delete movie
     * 
     * @Route("/api/mail/delete/{id<\d+>}", name="api_mail_delete", methods="DELETE")
     */
    public function delete(Mail $mail = null, EntityManagerInterface $entityManager)
    {

        if ($mail === null) {

            $message = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Message non trouvé.',
            ];

            return $this->json($message, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($mail);
        $entityManager->flush();

        return $this->json(
            ['message' => 'Le message a été supprimé !'],
            Response::HTTP_OK);
    }
}