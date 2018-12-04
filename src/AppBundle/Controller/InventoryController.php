<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Status;

class InventoryController extends AbstractController
{
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

    public function categoryAction(Request $request)
    {
        $error = '';
        $success = '';

        if($request->isMethod('post'))
        {
            $name = $request->request->get('name', '');

            if($name === '')
            {
                $error = 'Būtina įvesti pavadinimą';
            }
            else
            {
                $entityManager = $this->getDoctrine()->getManager();
                $category = new Category();
                $category->setName($name);
                $entityManager->persist($category);
                $entityManager->flush();

                $success = 'Kategorija sukurta';
            }
        }

        return $this->render('inventory/category.html.twig', [
            'success' => $success,
            'error' => $error
        ]);
    }

    public function statusAction(Request $request)
    {
        $error = '';
        $success = '';

        if($request->isMethod('post'))
        {
            $name = $request->request->get('name', '');

            if($name === '')
            {
                $error = 'Būtina įvesti pavadinimą';
            }
            else
            {
                $entityManager = $this->getDoctrine()->getManager();
                $status = new Status();
                $status->setName($name);
                $entityManager->persist($status);
                $entityManager->flush();

                $success = 'Būsena sukurta';
            }
        }

        return $this->render('inventory/status.html.twig', [
            'success' => $success,
            'error' => $error
        ]);
    }

    public function reportAction()
    {
        return $this->render('inventory/report.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }
}
