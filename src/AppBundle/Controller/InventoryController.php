<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventory", name="inventory")
     */
    public function indexAction()
    {
        return $this->render('inventory/index.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function showAction()
    {
        return $this->render('inventory/item.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function formAction()
    {
        return $this->render('inventory/item_form.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function categoryAction()
    {
        return $this->render('inventory/category.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function statusAction()
    {
        return $this->render('inventory/status.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function reportAction()
    {
        return $this->render('inventory/report.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }
}
