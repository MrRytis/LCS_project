<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function loginAction()
    {
        return $this->render('users/login.html.twig');
    }

    public function registerAction()
    {
        return $this->render('users/register.html.twig');
    }

    public function pendingAction()
    {
        return $this->render('users/pending.html.twig');
    }
}
