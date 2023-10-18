<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car', name: 'app_car')]
    public function index(): Response
    {
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
        ]);
    }
    #[Route('/addcar', name: 'car.add')]
    public function ajouterCar(ManagerRegistry $manager,Request $req): Response
    {
        $em = $manager->getManager();
        $Car = new Car();
        $form = $this->createForm(CarType::class,$Car);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($Car);
            $em->flush();
            return $this->redirectToRoute('car.show');
        }
        return $this->renderForm('car/add.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/showcar', name: 'car.show')]
    public function showCar(CarRepository $repo): Response
    {
        $x =$repo->findAll();
        return $this->render('car/show.html.twig', [
            'x' => $x,
        ]);
    }
    #[Route('/delcar/{id}', name: 'car.delete')]
    public function DeleteBook(CarRepository $repo,$id,ManagerRegistry $manager): Response
    {     $em = $manager->getManager();

        $x = $repo->find($id);
        $em->remove($x);
        $em->flush();
        return $this->redirectToRoute('car.show');
    }

    #[Route('/editcar/{id}', name: 'car.edit')]
    public function editBook(ManagerRegistry $manager,Request $req,$id,CarRepository $repo): Response
    {
        $em = $manager->getManager();
        $x = $repo->find($id);
        $form = $this->createForm(CarType::class,$x);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($x);
            $em->flush();
            return $this->redirectToRoute('car.show');
        }
        return $this->renderForm('car/edit.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/redirectcar',name:'car.redirect')]
     public function redirectCar(){
        return $this->redirectToRoute('car.show');
    }
}


