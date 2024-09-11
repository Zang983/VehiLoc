<?php

namespace App\Controller;

use App\Repository\CarRepository;
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
}
