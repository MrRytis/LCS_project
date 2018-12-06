<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produktai;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->redirectToRoute("main");
    }

    public function mainAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $user->setLastLogin(new \DateTime('now'));
        $entityManager->persist($user);
        $entityManager->flush();

        $product = $this->getDoctrine()->getRepository(Produktai::class)->findAll();

        return $this->render('index/index.html.twig', [
            'products' => $product,
        ]);
    }
}
