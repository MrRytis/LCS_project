<?php
/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 18.11.7
 * Time: 19.06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\SiuntimoBudai;
use AppBundle\Entity\Transportavimai;
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
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $obj = new Transportavimai();
            $obj->setpristatymoAdresas($_POST["pristatymoAdresas"]);
            $obj->setissiuntimoAdresas($_POST["issiuntimoAdresas"]);
            $budas = $this->getDoctrine()
                ->getRepository(SiuntimoBudai::class)->find($_POST["method"]);
            $obj->setsiuntimoBudas($budas);
            $obj->setFkUzsakymasid(0);//cia reikia normalu id uzsakymo paimt. Ryti padarysi?

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();
            header("Location: /orders/order_payment");
            exit;
        }
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
}