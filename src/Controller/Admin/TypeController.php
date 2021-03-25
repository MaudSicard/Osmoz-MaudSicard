<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Admin BookController
 */
class TypeController extends AbstractController
{
  /**
     * 
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
     * @Route("/admin/book/read/{id<\d+>}", name="admin_book_update", methods={"GET"})
     */
    public function readById ()
    {
        // to do
    }

    /**
     * @Route("/admin/book/create/", name="admin_book_create", methods={"GET"})
     */
    public function create ()
    {
        // to do
    }

      /**
     * @Route("/admin/book/update/{id<\d+>}", name="admin_book_update", methods={"GET"})
     */
    public function update ()
    {
        // to do
    }

    /**
     * 
     * @Route("/admin/type/delete/{id<\d+>}", name="admin_type_delete", methods={"GET"})
     */
    public function delete(Type $type = null, EntityManagerInterface $entityManager)
    {
        if ($type === null) {
            throw $this->createNotFoundException('type non trouvé.');
        }

        $entityManager->remove($type);
        $entityManager->flush();

        return $this->redirectToRoute('admin_type_read');
    }

}