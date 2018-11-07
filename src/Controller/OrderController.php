<?php
/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 18.11.7
 * Time: 19.06
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/new_order", name="new_order")
     */
    public function index()
    {
        return $this->render('orders/new_order.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function payment()
    {
        return $this->render('orders/order_payment.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function list()
    {
        return $this->render('orders/order_list.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function edit()
    {
        return $this->render('orders/edit_order.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}