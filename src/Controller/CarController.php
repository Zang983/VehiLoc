<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AddCarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CarRepository $repository): Response
    {
        $cars = $repository->findAll();
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
        ]);
    }

    #[Route('/detailCar/{id}', name: 'detailCar')]
    public function detailCar(CarRepository $repository, $id): Response
    {
        $car = $repository->find($id);
        if(!$car){
            return $this->redirectToRoute('home');
        }
        return $this->render('car/detailCar.html.twig', [
            'controller_name' => 'CarController',
            'car' => $car,
        ]);
    }

    #[Route('/deleteCar/{id}', name: 'deleteCar')]
    public function deleteCar(EntityManagerInterface $manager, Car $car): Response
    {
        $repo = $manager->getRepository(Car::class);
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('home');
    }

    #[Route('/createCar', name: 'createCar')]
    public function createCar(
        EntityManagerInterface $manager,
        Request $request
    ): Response {
        $form = $this->createForm(AddCarType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('car/createCar.html.twig', [
            'controller_name' => 'CarController',
            'form' => $form->createView(),
        ]);
    }
}
