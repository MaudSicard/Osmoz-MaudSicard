<?php

namespace App\Controller\Admin;

use App\Entity\Mail;
use App\Form\MailType;
use App\Repository\MailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    /**
     * @Route("admin/mail/read", name="admin_mail_read", methods={"GET"})
     */
    public function read(MailRepository $mailRepository): Response
    {
        return $this->render('admin/mail/mail_read.html.twig', [
            'mails' => $mailRepository->findAllOrderedByCreatedAT(),
        ]);
    }

    /**
     * Edit Mail
     * 
     * @Route("/admin/mail/edit/{id}", name="admin_mail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mail $mail): Response
    {
        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_mail_read');
        }

        return $this->render('admin/mail/mail_edit.html.twig', [
            'mail' => $mail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete Mails
     * 
     * @Route("/admin/mail/delete/{id<\d+>}", name="admin_mail_delete", methods={"DELETE"})
     */
    public function delete(Mail $mail = null, Request $request, EntityManagerInterface $entityManager)
    {
        if ($mail === null) {
            throw $this->createNotFoundException('Mail non trouvé.');
        }

        $submittedToken = $request->request->get('token');

        if (! $this->isCsrfTokenValid('delete-mail', $submittedToken)) {
            
            throw $this->createAccessDeniedException('Are you token to me !??!??');
        }

        $entityManager->remove($mail);
        $entityManager->flush();

        return $this->redirectToRoute('admin_mail_read');
    }

}