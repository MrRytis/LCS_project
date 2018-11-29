<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('Admin/admin_panel.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function dimensionsAction()
    {
        return $this->render('Admin/dimensions.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function fillerAction()
    {
        return $this->render('Admin/filler.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function shipping_methodsAction()
    {
        return $this->render('Admin/shipping_methods.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    public function reportAction()
    {
        return $this->render('Admin/report.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}