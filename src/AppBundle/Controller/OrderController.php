<?php
/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 18.11.7
 * Time: 19.06
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('orders/new_order.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function paymentAction()
    {
        return $this->render('orders/order_payment.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function listAction()
    {
        return $this->render('orders/order_list.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function editAction()
    {
        return $this->render('orders/edit_order.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    public function newOrderAction()
    {
        return $this->render('orders/new_order.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}