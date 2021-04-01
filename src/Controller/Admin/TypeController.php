<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Admin TypeController
 */
class TypeController extends AbstractController
{
  /**
     * Read all types
     *
     * @Route("/admin/type/read", name="admin_type_read", methods={"GET"})
     */
    public function read(TypeRepository $typeRepository): Response
    {
       $types = $typeRepository->findAll();

        return $this->render('admin/type/type_read.html.twig', [
            'types' => $types,
        ]);
    }


    /**
     * Add a new type in the database
     * 
     * @Route("/admin/type/create/", name="admin_type_create", methods={"GET","POST"})
     */
    public function create (Request $request)
    {
        $type = new Type();

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('admin_type_read');
        }

        return $this->render('admin/type/type_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

      
    /**
     * Update a type
     * 
     * @Route("/admin/type/update/{id<\d+>}", name="admin_type_update", methods={"GET","POST"})
     */
    public function update (Request $request, Type $type)
    {
        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_type_read');
        }

        return $this->render('admin/type/type_edit.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a type
     * 
     * @Route("/admin/type/delete/{id<\d+>}", name="admin_type_delete", methods={"GET"})
     */
    public function delete(Type $type = null, EntityManagerInterface $entityManager, Request $request)
    {
        if ($type === null) {
            throw $this->createNotFoundException('type non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-type', $submittedToken)) {
            
            throw $this->createAccessDeniedException('non autorisé');
        }

        $entityManager->remove($type);
        $entityManager->flush();

        return $this->redirectToRoute('admin_type_read');
    }

}