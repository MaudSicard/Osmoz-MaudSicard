<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
        /**
         * @Route("back/users/read", name="back_user_read", methods={"GET"})
         */
        public function browse(UserRepository $userRepository): Response
        {
            $users = $userRepository->findAll();

            return $this->render('admin/user/read.html.twig', [
                'users' => $userRepository->findAll(),
            ]);
        }
    }