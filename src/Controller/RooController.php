<?php

namespace App\Controller;

use App\Entity\Roo;
use App\Form\RooType;
use App\Repository\RooRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RooController extends AbstractController
{
    #[Route('/roo', name: 'app_roo')]
    public function index(): Response
    {
        return $this->render('roo/index.html.twig', [
            'controller_name' => 'RooController',
        ]);
    }
    #[Route('/addroo', name: 'roo.add')]
    public function ajoutBook(ManagerRegistry $manager,Request $req): Response
    {
        $em = $manager->getManager();
        $roo = new Roo();
        $form = $this->createForm(RooType::class,$roo);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($roo);
            $em->flush();
            return $this->redirectToRoute('roo.show');
        }
        return $this->renderForm('roo/add.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/showroo', name: 'roo.show')]
    public function showRoo(RooRepository $repo): Response
    {
        $x = $repo->findAll();
        return $this->renderForm('roo/show.html.twig', [
            'x' => $x,
        ]);
    }
    #[Route('/delroo/{id}', name: 'roo.delete')]
    public function DeleteBook(RooRepository $repo,$id,ManagerRegistry $manager): Response
    {     $em = $manager->getManager();

        $x = $repo->find($id);
        $em->remove($x);
        $em->flush();
        return $this->redirectToRoute('roo.show');
    }
    #[Route('/editroo/{id}', name: 'roo.edit')]
    public function editBook(ManagerRegistry $manager,Request $req,$id,RooRepository $repo): Response
    {
        $em = $manager->getManager();
        $x = $repo->find($id);
        $form = $this->createForm(RooType::class,$x);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($x);
            $em->flush();
            return $this->redirectToRoute('roo.show');
        }
        return $this->renderForm('roo/edit.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/redirectroo', name:'roo.redirect')]

    public function redirectRoo():Response
    {
        return $this->redirectToRoute('roo.add');
    }
}
