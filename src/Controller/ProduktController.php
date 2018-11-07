<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    public function tiek()
    {
        return $this->render('produkt/tiek.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function medz_gr()
    {
        return $this->render('produkt/medz_gr.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function produkt()
    {
        return $this->render('produkt/produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_tiek()
    {
        return $this->render('produkt/add_tiek.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_medz_gr()
    {
        return $this->render('produkt/add_medz_gr.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_tiek_produkt()
    {
        return $this->render('produkt/add_tiek_produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function add_produkt()
    {
        return $this->render('produkt/add_produkt.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
    public function ataskaita()
    {
        return $this->render('produkt/ataskaita.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
}
