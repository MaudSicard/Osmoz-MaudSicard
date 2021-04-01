<?php

namespace App\Controller\Admin;

use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Repository\MovieRepository;
use App\Repository\MusicRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("admin/home", name="admin_home", methods={"GET"})
     */
    public function Home(UserRepository $userRepository, MovieRepository $movieRepository, BookRepository $bookRepository, MusicRepository $musicRepository): Response
    {
        return $this->render('admin/home.html.twig', [
            'users' => $userRepository->findUsersHome(),
            'musics' => $musicRepository->findMusicsHome(),
            'movies' => $movieRepository->findMoviesHome(),
            'books' => $bookRepository->findBooksHome(),
        ]);
    }
}