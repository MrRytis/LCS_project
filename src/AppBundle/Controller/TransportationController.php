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
        $dimensions = $this->getDoctrine()->getRepository(Matmenys::class)->findAll();
        $filters = $this->getDoctrine()->getRepository(Uzpildai::class)->findAll();
        $methods = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->findAll();

        return $this->render('Order/transportation.html.twig', [
            'controller_name' => 'TransportationController',
            'dimensions' => $dimensions,
            'filters' => $filters,
            'methods' => $methods,
        ]);
    }
}