<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventory", name="inventory")
     */
    public function index()
    {
        return $this->render('inventory/index.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function show()
    {
        return $this->render('inventory/item.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function form()
    {
        return $this->render('inventory/item_form.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function category()
    {
        return $this->render('inventory/category.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function status()
    {
        return $this->render('inventory/status.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }

    public function report()
    {
        return $this->render('inventory/report.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }
}
