<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\LcsUser;
use AppBundle\Entity\AccountRequest;
use AppBundle\Entity\Worker;
use AppBundle\Entity\UserRole;

class UsersController extends AbstractController
{
    public function indexAction()
    {
        $user = $this->getUser();

        $role = $user->getType()->getName() === 'ROLE_KLIENTAS' ? 'Klientas' : '';
        $role = $user->getType()->getName() === 'ROLE_DARBUOTOJAS' ? 'Darbuotojas' : $role;
        $role = $user->getType()->getName() === 'ROLE_ADMINISTRATORIUS' ? 'Administratorius' : $role;

        $salary = '';

        $entityManager = $this->getDoctrine()->getManager();
        $worker = $entityManager->createQuery(
            'SELECT w
            FROM AppBundle:Worker w
            WHERE w.account = :user'
        )->setParameter('user', $user->getId())->getOneOrNullResult();

        if($worker)
        {
            $salary = $worker->getSalary();
        }

        return $this->render('users/index.html.twig', [
            'user' => $user,
            'role' => $role,
            'salary' => $salary
        ]);
    }

    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $email = $authenticationUtils->getLastUsername();

        return $this->render('users/login.html.twig', array(
            'last_username' => $email,
            'error' => $error
        ));
    }

    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $lastEmail = '';
        $lastName = '';
        $lastSurname = '';
        $error = false;
        $errorMsgs = array();

        if($request->isMethod('post'))
        {
            $lastEmail = $request->request->get('email', '');
            $lastName = $request->request->get('name', '');
            $lastSurname = $request->request->get('surname', '');
            $password = $request->request->get('password', '');
            $repeat = $request->request->get('password-repeat', '');
            $type = $request->request->get('user-type', '');

            if($lastEmail === '')
            {
                $error = true;
                $errorMsgs[] = 'Būtina įvesti el. paštą';
            }
            if($lastName === '')
            {
                $error = true;
                $errorMsgs[] = 'Būtina įvesti vardą';
            }
            if($lastSurname === '')
            {
                $error = true;
                $errorMsgs[] = 'Būtina įvesti pavardę';
            }
            if($password === '')
            {
                $error = true;
                $errorMsgs[] = 'Būtina įvesti slatpažodį';
            }
            if($password !== $repeat)
            {
                $error = true;
                $errorMsgs[] = 'Slaptažodis nesutampa su pakartotų slaptažodžiu';
            }

            $foundType = $type === 'Klientas' ? 'ROLE_KLIENTAS' : '';
            $foundType = $type === 'Darbuotojas' ? 'ROLE_DARBUOTOJAS' : $foundType;
            $foundType = $type === 'Administratorius' ? 'ROLE_ADMINISTRATORIUS' : $foundType;

            if($foundType === '')
            {
                $error = true;
                $errorMsgs[] = 'Negalimas vartotojo tipas';
            }

            if(!$error)
            {
                $entityManager = $this->getDoctrine()->getManager();
                $role = $entityManager->createQuery(
                    'SELECT u
                    FROM AppBundle:UserRole u
                    WHERE u.name = :type'
                )->setParameter('type', $foundType)->getOneOrNullResult();

                $user = new LcsUser();
                $encoded = $encoder->encodePassword($user, $password);

                $accRequest = new AccountRequest();
                $accRequest->setEmail($lastEmail);
                $accRequest->setName($lastName);
                $accRequest->setSurname($lastSurname);
                $accRequest->setPassword($encoded);
                $accRequest->setApplyDate(new \DateTime('now'));
                $accRequest->setType($role);

                if($foundType === 'ROLE_KLIENTAS')
                {
                    $accRequest->setAccepted(true);
                    $entityManager->persist($accRequest);

                    $user->setEmail($lastEmail);
                    $user->setName($lastName);
                    $user->setSurname($lastSurname);
                    $user->setPassword($encoded);
                    $user->setRegistration(new \DateTime('now'));
                    $user->setType($role);
                    $user->setAccountRequest($accRequest);

                    $entityManager->persist($user);
                    $entityManager->flush();

                    return $this->redirectToRoute('login');
                }
                else
                {
                    $accRequest->setAccepted(false);
                    $entityManager->persist($accRequest);
                    $entityManager->flush();

                    return $this->redirectToRoute('login');
                }
            }
        }

        return $this->render('users/register.html.twig', [
            'error' => $error,
            'error_msgs' => $errorMsgs,
            'last_email' => $lastEmail,
            'last_name' => $lastName,
            'last_surname' => $lastSurname,
        ]);
    }

    public function pendingAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(AccountRequest::class);
        $workersRepository = $this->getDoctrine()->getRepository(Worker::class);
        $entityManager = $this->getDoctrine()->getManager();

        if($request->isMethod('post'))
        {
            $id = $request->request->get('id', '');
            $action = $request->request->get('accept', '');
            $action = $request->request->get('reject', $action);

            $user = $this->getUser();
            $worker = $workersRepository->createQueryBuilder('w')
                ->where('w.account = :user')
                ->setParameter('user', $user->getId())
                ->getQuery()
                ->getOneOrNullResult();

            $accRequest = $repository->createQueryBuilder('r')
                    ->where('r.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getOneOrNullResult();
            
            if($accRequest)
            {
                $accRequest->setWorker($worker);
                $accRequest->setAccepted($action === 'Patvirtinti');

                $entityManager->persist($accRequest);
                $entityManager->flush();

                if($action === 'Patvirtinti')
                {
                    $newUser = new LcsUser();
                    $newUser->setName($accRequest->getName());
                    $newUser->setSurname($accRequest->getSurname());
                    $newUser->setEmail($accRequest->getEmail());
                    $newUser->setPassword($accRequest->getPassword());
                    $newUser->setRegistration(new \DateTime('now'));
                    $newUser->setAccountRequest($accRequest);
                    $newUser->setType($accRequest->getType());

                    $entityManager->persist($newUser);
                    $entityManager->flush();

                    $workerAcc = new Worker();
                    $workerAcc->setSalary(500);
                    $workerAcc->setAccount($newUser);

                    $entityManager->persist($workerAcc);
                    $entityManager->flush();
                }
            }
            else
            {

            }
        }

        $pendingAccounts = $repository->createQueryBuilder('u')
            ->where('u.accepted = false AND u.worker IS NULL')
            ->orderBy('u.applyDate', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('users/pending.html.twig', [
            'requests' => $pendingAccounts
        ]);
    }
}
