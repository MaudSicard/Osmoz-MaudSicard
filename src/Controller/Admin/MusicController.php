<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Form\MusicType;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
       * Read all musics
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
     * Update a music
     * 
     * @Route("/admin/music/update/{id<\d+>}", name="admin_music_update", methods={"GET","POST"})
     */
    public function update(Music $music, Request $request)
    { 
        $form = $this->createForm(MusicType::class, $music);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Musique modifié');

            return $this->redirectToRoute('admin_music_read');
        }

        return $this->render('admin/music/music_edit.html.twig', [
            'music' => $music,
            'form' => $form->createView(),
        ]);
    }


    /**
     * Delete a music
     * 
     * @Route("/admin/music/delete/{id<\d+>}", name="admin_music_delete", methods={"DELETE"})
     */
    public function delete(Music $music = null, EntityManagerInterface $entityManager, Request $request)
    {
        if ($music === null) {
            throw $this->createNotFoundException('musique non trouvés');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-music', $submittedToken)) {
            
            throw $this->createAccessDeniedException('non autorisé');
        }

        $entityManager->remove($music);
        $entityManager->flush();

        $this->addFlash('success', 'Musique supprimé');

        return $this->redirectToRoute('admin_music_read');
    }

}