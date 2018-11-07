<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransportationController extends AbstractController
{
    /**
     * @Route("/transportation", name="transportation")
     */
    public function index()
    {
        return $this->render('Order/transportation.html.twig', [
            'controller_name' => 'TransportationController',
        ]);
    }
}