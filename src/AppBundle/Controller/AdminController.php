<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AtaskaitosTipai;
use AppBundle\Entity\Matmenys;
use AppBundle\Entity\SiuntimoBudai;
use AppBundle\Entity\Transportavimai;
use AppBundle\Entity\Uzpildai;
use AppBundle\Entity\Uzsakymai;
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
        $error="";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $item = $this->getDoctrine()->getRepository(Matmenys::class)->find($_POST["deleteID"]);
            $obj = $this->getDoctrine()->getRepository(Uzsakymai::class)->findOneBy(['pakuotesIsmatavimai'=>$item]);
            if(!is_null($obj)){
                $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
            }else {
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
            }
        }
        $dimensions = $this->getDoctrine()->getRepository(Matmenys::class)->findAll();
//        dump($dimensions);
//        die();
        return $this->render('Admin/dimensions.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $dimensions,
            'error'=>$error
        ]);
    }
    public function add_dimensionAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(Matmenys::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $item->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                header("Location: /admin/dimensions");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = new Matmenys();
                $obj->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /admin/dimensions");
                exit;
            }
        }
        return $this->render('Admin/add_dimension.html.twig', [
            'controller_name' => 'AdminController',
            'item'=>$item
        ]);
    }
    public function fillerAction()
    {
        $error="";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $item = $this->getDoctrine()->getRepository(Uzpildai::class)->find($_POST["deleteID"]);
            $obj = $this->getDoctrine()->getRepository(Uzsakymai::class)->findOneBy(['pakuotesUzpildas'=>$item]);
            if(!is_null($obj)){
                $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
            }else {
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
            }
        }
        $filters = $this->getDoctrine()->getRepository(Uzpildai::class)->findAll();
        return $this->render('Admin/filler.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $filters,
            'error'=>$error
        ]);
    }
    public function add_fillerAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(Uzpildai::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $item->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                header("Location: /admin/filler");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = new Uzpildai();
                $obj->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /admin/filler");
                exit;
            }
        }
        return $this->render('Admin/add_filler.html.twig', [
            'controller_name' => 'AdminController',
            'item'=>$item
        ]);
    }
    public function shipping_methodsAction()
    {
        $error="";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $item = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->find($_POST["deleteID"]);
            $obj = $this->getDoctrine()->getRepository(Transportavimai::class)->findOneBy(['siuntimoBudas'=>$item]);
            if(!is_null($obj)){
                $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
            }else {
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
            }
        }
        $methods = $this->getDoctrine()->getRepository(SiuntimoBudai::class)->findAll();
        return $this->render('Admin/shipping_methods.html.twig', [
            'controller_name' => 'AdminController',
            'requests' => $methods,
            'error'=>$error
        ]);
    }
    public function add_shipping_methodAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(SiuntimoBudai::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $item->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                header("Location: /admin/shipping_methods");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = new SiuntimoBudai();
                $obj->setName($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /admin/shipping_methods");
                exit;
            }
        }
        return $this->render('Admin/add_shipping_method.html.twig', [
            'controller_name' => 'AdminController',
            'item'=>$item
        ]);
    }
    public function reportAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $orders = null;
        $timeFrom = new \DateTime('now');
        $timeTo = new \DateTime('now');
        if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            $timeFrom = $_POST["datenuo"];
            $timeTo = $_POST["dateiki"];
            $orders = $qb->select(array('o'))
                ->from('AppBundle:Uzsakymai', 'o')
                ->join('AppBundle:Transportavimai', 't')
                ->where('o.id = t.fkUzsakymasid')
                ->where('o.data > :timeFrom')
                ->andWhere('o.data < :timeTo')
                ->setParameter('timeFrom', $timeFrom)
                ->setParameter('timeTo', $timeTo)
                ->getQuery()
                ->getResult();
//            dump($orders);
//            die();
        }
        $types = $this->getDoctrine()->getRepository(AtaskaitosTipai::class)->findAll();

        return $this->render('Admin/report.html.twig', [
            'controller_name' => 'AdminController',
            'types' => $types,
            'orders' => $orders
        ]);
    }
}