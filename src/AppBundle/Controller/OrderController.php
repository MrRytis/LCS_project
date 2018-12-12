<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Atsiskaitymai;
use AppBundle\Entity\Client;
use AppBundle\Entity\Kiekiai;
use AppBundle\Entity\MedziaguGrupes;
use AppBundle\Entity\Produktai;
use AppBundle\Entity\Uzsakymai;
use AppBundle\Entity\SiuntimoBudai;
use AppBundle\Entity\Transportavimai;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function newAction(Request $request)
    {
        $referer = $request->headers->get('referer');
        $msg = null;
        if($referer == 'http://127.0.0.1:8000/order_new/remove/*')
        {
            $msg = "Istrynta sekmingai";
        }
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();

        $order = $entityManager->createQuery(
            'SELECT u
            FROM AppBundle:Uzsakymai u
            WHERE u.apmokejimaBusena = :apmokejimas AND u.fkKlientasid = :client')
            ->setParameter('apmokejimas', 0)->setParameter('client', $client->getId())->getOneOrNullResult();

        $products = $this->getDoctrine()->getRepository(Kiekiai::class)->findBy(
            array("fkUzsakymasid" => $order)
        );

        $suma = 0;

        foreach ($products as $product)
        {
            $suma = $product->getFkProduktasid()->getKaina() + $suma;
        }

        return $this->render('orders/new_order.twig', [
            'controller_name' => 'OrderController',
            'new_orders' => $products,
            'suma' => $suma,
            'msg' => $msg,
        ]);
    }

    /**
     * @param $id
     *
     * @Route("/order_new/Add/{id}", requirements={"id" = "\d+"}, name="add-to-order")
     * @return null
     *
     */
    public function newAddAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();



        $order = $entityManager->createQuery(
            'SELECT u
            FROM AppBundle:Uzsakymai u
            WHERE u.apmokejimaBusena = :apmokejimas AND u.fkKlientasid = :client')
            ->setParameter('apmokejimas', 0)->setParameter('client', $client->getId())->getOneOrNullResult();

        $product = $entityManager->createQuery(
            'SELECT p
            FROM AppBundle:Produktai p
            WHERE p.id = :id'
        )->setParameter('id', $id)->getOneOrNullResult();

        $entityManager = $this->getDoctrine()->getManager();



        if($order == null)
        {
            $order = new Uzsakymai();
            $order->setData(new \DateTime('now'));
            $order->setApmokejimaBusena(false);
            $order->setFkKlientasid($client);

            $entityManager->persist($order);

            $amount = new Kiekiai();
            $amount->setKiekis(1);
            $amount->setFkProduktasid($product);
            $amount->setFkUzsakymasid($order);

            $entityManager->persist($amount);
            $entityManager->flush();
        }
        else
        {
            $amount = new Kiekiai();
            $amount->setKiekis(1);
            $amount->setFkProduktasid($product);
            $amount->setFkUzsakymasid($order);

            $entityManager->persist($amount);
            $entityManager->flush();
        }

        return $this->redirect("/main");
    }


    /**
     * @param $id
     *
     * @Route("/order_new/remove/{id}", requirements={"id" = "\d+"}, name="remove-from-order")
     * @return null
     *
     */
    public function newOrderDeleteAction($id)
    {
        $amount =  $this->getDoctrine()->getRepository(Kiekiai::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($amount);
        $entityManager->flush();

        return $this->redirect("/orders/new");
    }

    public function paymentAction()
    {
        $methods = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->findAll();
        return $this->render('orders/order_payment.twig', [
            'controller_name' => 'OrderController',
            'methods' => $methods,
        ]);
    }

    /**
     * @param $request
     * @Route("/orders/payment/add", name="order-payment-add")
     * @return null
     */
    public function addPaymentToDBAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();

        $order = $entityManager->createQuery(
            'SELECT u
            FROM AppBundle:Uzsakymai u
            WHERE u.apmokejimaBusena = :apmokejimas AND u.fkKlientasid = :client')
            ->setParameter('apmokejimas', 0)->setParameter('client', $client->getId())->getOneOrNullResult();


        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $obj = new Transportavimai();
            $obj->setpristatymoAdresas($_POST["pristatymoAdresas"]);
            $obj->setissiuntimoAdresas($_POST["issiuntimoAdresas"]);
            $budas = $this->getDoctrine()
                ->getRepository(SiuntimoBudai::class)->find($_POST["method"]);
            $obj->setsiuntimoBudas($budas);
            $obj->setFkUzsakymasid($order);//cia reikia normalu id uzsakymo paimt. Ryti padarysi?


            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $client = $entityManager->createQuery(
                'SELECT c
                FROM AppBundle:Client c
                WHERE c.account = :user'
            )->setParameter('user', $user->getId())->getOneOrNullResult();
            $order = $entityManager->createQuery(
                'SELECT u
                    FROM AppBundle:Uzsakymai u
                    WHERE u.apmokejimaBusena = :apmokejimas AND u.fkKlientasid = :client')
                ->setParameter('apmokejimas', 0)->setParameter('client', $client->getId())->getOneOrNullResult();

            $em = $this->getDoctrine()->getManager();
            $or = $em->getRepository(Uzsakymai::class)->find($order->getId());
            if($_POST["insurance"] == "on")
            {
                $or->setDraudimas(1);
            }
            if($_POST["tracking"])
            {
                $or->setSekimas(1);
            }

            $entityManager->flush();

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();
        }

        if($request->isMethod('post'))
        {
            $cardNr = $request->request->get("card", "");

            $products = $this->getDoctrine()->getRepository(Kiekiai::class)->findBy(
                array("fkUzsakymasid" => $order)
            );

            $suma = 0;

            foreach ($products as $product)
            {
                $suma = $product->getFkProduktasid()->getKaina() + $suma;
            }

            $payment = new Atsiskaitymai();
            $payment->setData(new \DateTime('now'));
            $payment->setSuma($suma);
            $payment->setKortelesNr($cardNr);
            $payment->setFkUzsakymasid($order);
            $payment->setFkKlientasid($client);

            $pm = $entityManager->createQuery(
                'SELECT a
                FROM AppBundle:Atsiskaitymai a'
            )->getOneOrNullResult();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pm);
            $entityManager->flush();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($payment);
            $entityManager->flush();
            return $this->redirect("/orders/update");
        }
    }

    public function updateOrderAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();
        $order = $entityManager->createQuery(
            'SELECT u
            FROM AppBundle:Uzsakymai u
            WHERE u.apmokejimaBusena = :apmokejimas AND u.fkKlientasid = :client')
            ->setParameter('apmokejimas', 0)->setParameter('client', $client->getId())->getOneOrNullResult();

        $em = $this->getDoctrine()->getManager();
        $or = $em->getRepository(Uzsakymai::class)->find($order->getId());
        $or->setApmokejimaBusena(1);
        $entityManager->flush();
        return $this->redirect("/orders/list");
    }

    public function listAction(Request $request)
    {
        $referer = $request->headers->get('referer');
        $msg = null;
        if($referer == 'http://127.0.0.1:8000/orders/payment')
        {
           $msg = "Apmoketa sekmingai";
        }

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();


        $orders = $this->getDoctrine()->getRepository(Uzsakymai::class)->findBy(
            array("fkKlientasid" => $client->getId())
        );

        return $this->render('orders/order_list.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
            'msg' => $msg,
        ]);
    }

    /**
     * @Route("/orders/list/date/asc", name="order-sort-date-asc")
     * @return null
     */
    public function listSortByDateASCAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();

        $orders = $this->getDoctrine()->getRepository(Uzsakymai::class)->findBy(
            array("fkKlientasid" => $client->getId()),
            array("data" => "ASC")
        );

        return $this->render('orders/order_list.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/orders/list/date/desc", name="order-sort-date-desc")
     * @return null
     */
    public function listSortByDatDESCCAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $entityManager->createQuery(
            'SELECT c
        FROM AppBundle:Client c
        WHERE c.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();

        $orders = $this->getDoctrine()->getRepository(Uzsakymai::class)->findBy(
            array("fkKlientasid" => $client->getId()),
            array('data' => 'DESC')
        );

        return $this->render('orders/order_list.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
        ]);
    }

    /**
     * @param $id
     *
     * @Route("/order/list/{id}", requirements={"id" = "\d+"}, name="list")
     * @return null
     *
     */
    public function itemsListAction($id)
    {
        $products = $this->getDoctrine()->getRepository(Kiekiai::class)->findBy(
            array("fkUzsakymasid" => $id)
        );

        return $this->render('orders/products.twig', [
            'controller_name' => 'OrderController',
            'products' => $products,
        ]);
    }
}