<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tiekejai;
use AppBundle\Entity\MedziaguGrupes;
use AppBundle\Entity\Produktai;
use AppBundle\Entity\TiekejoProduktai;
use Symfony\Component\Validator\Constraints\DateTime;

class ProduktController extends AbstractController
{
    public function tiekAction()
    {
        $error = "";
        $dataNuo = null;
        $dataIki = null;
        $filter = 0;
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            if($_POST["deleteID"] != -1){
                $item = $this->getDoctrine()->getRepository(Tiekejai::class)->find($_POST["deleteID"]);
                $obj = $this->getDoctrine()->getRepository(TiekejoProduktai::class)->findOneBy(['fkTiekejasid'=>$item]);
                if(!is_null($obj)){
                    $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
                }else {
                    $em = $this->getDoctrine()->getEntityManager();

                    $em->remove($item);
                    $em->flush();
                }
                $filter = $_POST["filter"];
            }elseif ($_POST["deleteID2"] != -1){
                $item = $this->getDoctrine()->getRepository(TiekejoProduktai::class)->find($_POST["deleteID2"]);
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
                $filter = $_POST["filter"];
            }elseif (isset($_GET['filter'])){
                $dataNuo = $_POST["datenuo"];
                $dataIki = $_POST["dateiki"];
                $filter = $_GET['filter'];
            }
            if(isset($_POST["datenuo"]) && isset($_POST["dateiki"])){
                $dataNuo = $_POST["datenuo"];
                $dataIki = $_POST["dateiki"];
            }
        }
        $result = $this->getDoctrine()
            ->getRepository(Tiekejai::class)->findBy(array(), array('sukurimoData' => 'DESC'));
        $itemData = $this->getDoctrine()
            ->getRepository(TiekejoProduktai::class)->findAll();
        $produkts  = $this->getDoctrine()
            ->getRepository(Produktai::class)->findAll();
        $medzGr  = $this->getDoctrine()
            ->getRepository(MedziaguGrupes::class)->findAll();
        return $this->render('produkt/tiek.html.twig', [
            'controller_name' => 'ProduktController',
        'result'=>$result,
            'itemData'=>$itemData,
            'produkts'=>$produkts,
            'medzGr'=>$medzGr,
            'error'=>$error,
            'dataNuo'=>$dataNuo,
            'dataIki'=>$dataIki,
            'filter'=>$filter
            ] );
    }
    public function medz_grAction()
    {
        $error="";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $item = $this->getDoctrine()->getRepository(MedziaguGrupes::class)->find($_POST["deleteID"]);
            $obj = $this->getDoctrine()->getRepository(Produktai::class)->findOneBy(['fkMedziaguGrupeid'=>$item]);
            if(!is_null($obj)){
                $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
            }else {
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
            }
        }
        $medzGr  = $this->getDoctrine()
            ->getRepository(MedziaguGrupes::class)->findBy(array(), array('pavadinimas' => 'ASC'));
        return $this->render('produkt/medz_gr.html.twig', [
            'controller_name' => 'ProduktController',
            'medzGr'=>$medzGr,
            'error'=>$error
        ]);
    }
    public function produktAction()
    {
        $error="";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $item = $this->getDoctrine()->getRepository(Produktai::class)->find($_POST["deleteID"]);
            $obj = $this->getDoctrine()->getRepository(TiekejoProduktai::class)->findOneBy(['fkProduktasid'=>$item]);
            if(!is_null($obj)){
                $error = "Negalime ištrintinti objekto, nes objekto duomenys yra naudojami.";
            }else {
                $em = $this->getDoctrine()->getEntityManager();

                $em->remove($item);
                $em->flush();
            }
        }
        $medzGr  = $this->getDoctrine()
            ->getRepository(MedziaguGrupes::class)->findAll();
        $result = $this->getDoctrine()
            ->getRepository(Produktai::class)->findBy(array(), array('pavadinimas' => 'ASC'));
        return $this->render('produkt/produkt.html.twig', [
            'controller_name' => 'ProduktController',
            'result'=>$result,
            'medzGr'=>$medzGr,
            'error'=>$error
        ]);
    }
    public function add_tiekAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(Tiekejai::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $item->setVardas($_POST["tiekname"]);
                $item->setFirmosPav($_POST["firma"]);
                $item->setEPastas($_POST["emailTiek"]);
                $item->setVadybininkas($_POST["vadyb"]);
                $item->setFakturosNr($_POST["fknr"]);
                $item->setVadybininkoEPastas($_POST["emailVadyb"]);

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                header("Location: /tiek");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = new Tiekejai();
                $obj->setVardas($_POST["tiekname"]);
                $obj->setFirmosPav($_POST["firma"]);
                $obj->setEPastas($_POST["emailTiek"]);
                $obj->setVadybininkas($_POST["vadyb"]);
                $obj->setFakturosNr($_POST["fknr"]);
                $obj->setVadybininkoEPastas($_POST["emailVadyb"]);
                $obj->setSukurimoData(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /tiek");
                exit;
            }
        }
        return $this->render('produkt/add_tiek.html.twig', [
            'controller_name' => 'ProduktController','item'=>$item
        ]);
    }
    public function add_medz_grAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(MedziaguGrupes::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $item->setPavadinimas($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                header("Location: /medz_gr");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = new MedziaguGrupes();
                $obj->setPavadinimas($_POST["name"]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /medz_gr");
                exit;
            }
        }
        return $this->render('produkt/add_medz_gr.html.twig', [
            'controller_name' => 'ProduktController','item'=>$item
        ]);
    }
    public function add_tiek_produktAction()
    {
        $produkts  = $this->getDoctrine()
            ->getRepository(Produktai::class)->findAll();
        $item= null;
        $tiekItem = $this->getDoctrine()->getRepository(Tiekejai::class)->find($_GET['id']);
        $user = $this->getUser();
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(TiekejoProduktai::class)->find($_GET["idP"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $produktItem = $this->getDoctrine()->getRepository(Produktai::class)->find($_POST["produkt"]);
                $item->setFkProduktasid($produktItem);
                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();
                header("Location: /tiek");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $produktItem = $this->getDoctrine()->getRepository(Produktai::class)->find($_POST["produkt"]);
                $obj = new TiekejoProduktai();
                $obj->setFkProduktasid($produktItem);
                $obj->setFkTiekejasid($tiekItem);
                $obj->setSukurimoData(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /tiek");
                exit;
            }
        }
        return $this->render('produkt/add_tiek_produkt.html.twig', [
            'controller_name' => 'ProduktController',
            'item'=>$item,
            'produkts'=>$produkts,
            'tiekItem'=>$tiekItem
        ]);
    }
    public function add_produktAction()
    {
        $item= null;
        if(!empty($_GET["edit"]) && $_GET["edit"]==1){
            $item = $this->getDoctrine()
                ->getRepository(Produktai::class)->find($_GET["id"]);
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $obj = $this->getDoctrine()
                    ->getRepository(Produktai::class)->find($_GET["id"]);
                $medzItem = $this->getDoctrine()
                    ->getRepository(MedziaguGrupes::class)->find($_POST["medzGrSelect"]);
                $obj->setPavadinimas($_POST["name"]);
                $obj->setFkMedziaguGrupeid($medzItem);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /produkt");
                exit;
            }
        }
        else{
            if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                $medzItem = $this->getDoctrine()
                    ->getRepository(MedziaguGrupes::class)->find($_POST["medzGrSelect"]);
                $obj = new Produktai();
                $obj->setPavadinimas($_POST["name"]);
                $obj->setKaina(0);
                $obj->setSukurimoData(new \DateTime('now'));
                $obj->setFkMedziaguGrupeid($medzItem);

                $em = $this->getDoctrine()->getManager();
                $em->persist($obj);
                $em->flush();
                header("Location: /produkt");
                exit;
            }
        }
        $medzGrs = $this->getDoctrine()
            ->getRepository(MedziaguGrupes::class)->findAll();
        return $this->render('produkt/add_produkt.html.twig', [
            'controller_name' => 'ProduktController',
            'medzGrs'=>$medzGrs,
            'item'=>$item
        ]);
    }
    public function ataskaitaAction()
    {
        $tiekejai = $this->getDoctrine()->getRepository(Tiekejai::class)->findAll();
        $filtered = null;
        $ataskaita = false;
        $timeFrom = new \DateTime('now');
        $timeTo = new \DateTime('now');
        if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            $ataskaita = true;
            $timeFrom = $_POST["datenuo"];
            $timeTo = $_POST["dateiki"];
            if($_POST["tiekejas"] == -1){
                $filtered = null;
            }else{
                $filtered = $this->getDoctrine()->getRepository(Tiekejai::class)->find($_POST["tiekejas"]);
            }
        }
        $itemData = $this->getDoctrine()
            ->getRepository(TiekejoProduktai::class)->findAll();
        return $this->render('produkt/ataskaita.html.twig', [
            'controller_name' => 'ProduktController',
            'tiekejai'=>$tiekejai,
            'ataskaita'=>$ataskaita,
            'timeFrom'=>$timeFrom,
            'timeTo'=>$timeTo,
            'itemData'=>$itemData,
            'filtered'=>$filtered
        ]);
    }
}
