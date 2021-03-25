<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Admin MusicController
 */
class MusicController extends AbstractController
{
    /**
       *
       *
       * @Route("/admin/music/read", name="admin_music_read", methods={"GET"})
       */
    public function read(MusicRepository $musicRepository): Response
    {
        $musics = $musicRepository->findAllMusicByUserType();

        return $this->render('admin/music/music_read.html.twig', [
            'musics' => $musics,
        ]);
    }


    /**
     *
     * @Route("/admin/music/delete/{id<\d+>}", name="admin_music_delete", methods={"GET"})
     */
    public function delete(Music $music = null, EntityManagerInterface $entityManager)
    {
        if ($music === null) {
            throw $this->createNotFoundException('musique non trouvés');
        }

        $entityManager->remove($music);
        $entityManager->flush();

        return $this->redirectToRoute('admin_music_read');
    }

    /**
     * @Route("/admin/music/update/{id<\d+>}", name="admin_book_update", methods={"GET"})
     */
    public function update()
    { // to do
    }
}