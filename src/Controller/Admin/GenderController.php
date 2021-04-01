<?php

namespace App\Controller\Admin;

use App\Entity\Gender;
use App\Form\GenderType;
use App\Repository\GenderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Admin TypeController
 */
class GenderController extends AbstractController
{
  /**
     * Read all genders
     *
     * @Route("/admin/gender/read", name="admin_gender_read", methods={"GET"})
     */
    public function read(GenderRepository $genderRepository): Response
    {
       $genders = $genderRepository->findAll();

        return $this->render('admin/gender/gender_read.html.twig', [
            'genders' => $genders,
        ]);
    }


    /**
     * Add a new gender in the database
     * 
     * @Route("/admin/gender/create", name="admin_gender_create", methods={"GET","POST"})
     */
    public function create (Request $request)
    {
        $gender = new Gender();

        $form = $this->createForm(GenderType::class, $gender);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gender);
            $entityManager->flush();

            return $this->redirectToRoute('admin_gender_read');
        }

        return $this->render('admin/gender/gender_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

      
    /**
     * Update a gender
     * 
     * @Route("/admin/gender/update/{id<\d+>}", name="admin_gender_update", methods={"GET","POST"})
     */
    public function update (Request $request, Gender $gender)
    {
        $form = $this->createForm(GenderType::class, $gender);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_gender_read');
        }

        return $this->render('admin/gender/gender_edit.html.twig', [
            'gender' => $gender,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a gender
     * 
     * @Route("/admin/gender/delete/{id<\d+>}", name="admin_gender_delete", methods={"GET"})
     */
    public function delete(Gender $gender = null, EntityManagerInterface $entityManager, Request $request)
    {
        if ($gender === null) {
            throw $this->createNotFoundException('genre non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-gender', $submittedToken)) {
            
            throw $this->createAccessDeniedException('non autorisé');
        }

        $entityManager->remove($gender);
        $entityManager->flush();

        return $this->redirectToRoute('admin_gender_read');
    }

}