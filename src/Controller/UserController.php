<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class UserController extends AbstractController
{
    public function getUsers(PersistenceManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $listUsers = $em->getRepository(Users::class)->findBy([], ['name' => 'ASC']);
        return $this->render('user/users.html.twig', [
            'listUsers' => $listUsers
        ]);
    }

    public function createUser(Request $request,PersistenceManagerRegistry $doctrine){
        $em = $doctrine->getManager();

        $users = new \App\Entity\Users();

        $form_users = $this->createForm(\App\Form\UsersType::class, $users);
        $form_users->handleRequest($request);

        if($form_users->isSubmitted() && $form_users->isValid()){
            $users->setStatus(1);
            $em->persist($users);
            $em->flush();

            return $this->redirectToRoute('getUsers');
        }

        return $this->render('user/user_create.html.twig', [
            'form_users' => $form_users->createView()
        ]);
    }


    public function deleteUser(Request $request,PersistenceManagerRegistry $doctrine, $id){
        $em = $doctrine->getManager();

        $users = $em->getRepository(Users::class)->find($id);

        $users->setStatus(0);
        $em->persist($users);
        $em->flush();
        
        return $this->redirectToRoute('getUsers');
    }

    public function updateUser(Request $request,PersistenceManagerRegistry $doctrine, $id){
        $em = $doctrine->getManager();

        $users = $em->getRepository(Users::class)->find($id);

        $form_users = $this->createForm(\App\Form\UsersType::class, $users);
        $form_users->handleRequest($request);

        if($form_users->isSubmitted() && $form_users->isValid()){
            $em->persist($users);
            $em->flush();

            return $this->redirectToRoute('getUsers');
        }

        return $this->render('user/user_update.html.twig', [
            'form_users' => $form_users->createView()
        ]);
    }
}
