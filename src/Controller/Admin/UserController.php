<?php

namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\MailRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * Read all users
     * 
     * @Route("back/users/read", name="back_user_read", methods={"GET"})
     */
    public function read(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/user_read.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * Read  one user
     * 
     * @Route("back/read/{id}", name="back_user_read_item", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/user_show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * 
     * 
     * @Route("back/user/add", name="back_user_add", methods={"GET","POST"})
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {    
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $hashedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            
            $user->setPassword($hashedPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('back_user_read');
        }

        return $this->render('admin/user/user_add.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     *  Edit user
     * 
     * @Route("back/user/edit/{id}", name="back_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('password')->getData() !== '') {
             
                $hashedPassword = $passwordEncoder->encodePassword($user, $form->get('password')->getData());

                $user->setPassword($hashedPassword);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_user_read');
        }

        return $this->render('admin/user/user_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete user
     * 
     * @Route("back/user/delete/{id}", name="back_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_user_read');
    }
}