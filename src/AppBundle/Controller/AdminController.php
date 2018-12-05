<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AtaskaitosTipai;
use AppBundle\Entity\Matmenys;
use AppBundle\Entity\SiuntimoBudai;
use AppBundle\Entity\Uzpildai;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $dimensions = $this->getDoctrine()->getRepository(Matmenys::class)->findAll();
//        dump($dimensions);
//        die();
        return $this->render('Admin/dimensions.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $dimensions,
        ]);
    }
    public function fillerAction()
    {
        $filters = $this->getDoctrine()->getRepository(Uzpildai::class)->findAll();
        return $this->render('Admin/filler.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $filters,
        ]);
    }
    public function shipping_methodsAction()
    {
        $methods = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->findAll();
        return $this->render('Admin/shipping_methods.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $methods,
        ]);
    }
    public function reportAction()
    {
        $reports = $this->getDoctrine()->getRepository(AtaskaitosTipai::class)->findAll();

        return $this->render('Admin/report.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $reports,
        ]);
    }
}