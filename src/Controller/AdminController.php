<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('Admin/admin_panel.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function dimensions()
    {
        return $this->render('Admin/dimensions.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function filler()
    {
        return $this->render('Admin/filler.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function shipping_methods()
    {
        return $this->render('Admin/shipping_methods.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function report()
    {
        return $this->render('Admin/report.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}