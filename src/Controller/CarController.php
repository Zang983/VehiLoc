<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/deleteCar/{id}', name: 'deleteCar')]
    public function deleteCar(EntityManagerInterface $manager, $id): Response
    {
        $repo = $manager->getRepository(Car::class);
        $car = $repo->find($id);
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('home');
    }
}
