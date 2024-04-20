<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/measurement', name: 'app_measurement')]
class MeasurementController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('measurement/index.html.twig', [
            'controller_name' => 'MeasurementController',
        ]);
    }
}
