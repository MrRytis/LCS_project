<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransportationController extends AbstractController
{
    /**
     * @Route("/transportation", name="transportation")
     */
    public function indexAction()
    {
        return $this->render('Order/transportation.html.twig', [
            'controller_name' => 'TransportationController',
        ]);
    }
}