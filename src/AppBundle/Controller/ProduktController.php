<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    public function tiekAction()
    {
        return $this->render('produkt/tiek.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function medz_grAction()
    {
        return $this->render('produkt/medz_gr.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function produktAction()
    {
        return $this->render('produkt/produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_tiekAction()
    {
        return $this->render('produkt/add_tiek.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_medz_grAction()
    {
        return $this->render('produkt/add_medz_gr.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_tiek_produktAction()
    {
        return $this->render('produkt/add_tiek_produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_produktAction()
    {
        return $this->render('produkt/add_produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function ataskaitaAction()
    {
        return $this->render('produkt/ataskaita.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
}
