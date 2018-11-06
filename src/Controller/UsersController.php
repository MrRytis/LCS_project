<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function login()
    {
        return $this->render('users/login.html.twig');
    }

    public function register()
    {
        return $this->render('users/register.html.twig');
    }

    public function pending()
    {
        return $this->render('users/pending.html.twig');
    }
}
