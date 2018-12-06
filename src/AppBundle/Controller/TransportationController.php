<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use AppBundle\Entity\Uzpildai;
use AppBundle\Entity\Matmenys;
use AppBundle\Entity\SiuntimoBudai;
use Symfony\Component\Routing\Annotation\Route;

class TransportationController extends AbstractController
{
    public function indexAction()
    {
        $methods = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->findAll();

        return $this->render('Order/transportation.html.twig', [
            'controller_name' => 'TransportationController',
            'methods' => $methods,
        ]);
    }
}