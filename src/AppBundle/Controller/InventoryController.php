<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Status;
use AppBundle\Entity\Item;

class InventoryController extends AbstractController
{
    public function indexAction(Request $request)
    {
        $search = $request->query->get('search', '');
        $entityManager = $this->getDoctrine()->getManager();
        $items = array();

        if($search === '')
        {
            $items = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.deleted IS NULL'
            )->getResult();
        }
        else
        {
            $items = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE LOWER(i.name) LIKE :word_start OR LOWER(i.name) LIKE :name_start AND i.deleted IS NULL'
            )->setParameter('word_start', '% ' . strtolower($search) . '%')
            ->setParameter('name_start', strtolower($search) . '%')
            ->getResult();
        }

        return $this->render('inventory/index.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'items' => $items
        ]);
    }

    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $item = $entityManager->createQuery(
            'SELECT i
            FROM AppBundle:Item i
            WHERE i.id = :id'
        )->setParameter('id', $id)->getOneOrNullResult();

        return $this->render('inventory/item.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'item' => $item
        ]);
    }

    public function formAction(Request $request)
    {
        $error = '';
        $success = '';

        $id = $request->query->get('id', '');
        //echo($id);
        $dummyCategory = new Category();
        $dummyCategory->setId(0);
        $item = new Item();
        $item->setName('');
        $item->setValue(0);
        $item->setCategory($dummyCategory);

        if($id !== '')
        {
            $entityManager = $this->getDoctrine()->getManager();
            $foundItem = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.id = :id'
            )->setParameter('id', $id)->getOneOrNullResult();

            //var_dump($foundItem);
        }

        if($request->isMethod('post'))
        {
            $id = $request->request->get('id', '');
            if($id === '') // new item
            {
                $statuses = $this->getStatuses();
                $status = $statuses[0];

                $name = $request->request->get('name', '');
                $price = $request->request->get('price', '');
                $categoryId = $request->request->get('category', '');

                if($name === '')
                {
                    $error = 'Būtina įrašyti pavadinimą';
                }
                if($price === '')
                {
                    $error = 'Būtina įrašyti vertę';
                }

                if($error === '')
                {
                    $entityManager = $this->getDoctrine()->getManager();
                    $item->setName($name);
                    $item->setAdded(new \DateTime('now'));
                    $item->setValue($price);
                    $item->setStatus($status);

                    if($categoryId !== '')
                    {
                        $category = $entityManager->createQuery(
                            'SELECT c
                            FROM AppBundle:Category c
                            WHERE c.id = :id'
                        )->setParameter('id', $categoryId)->getOneOrNullResult();
                        $item->setCategory($category);
                    }

                    $entityManager->persist($item);
                    $entityManager->flush();

                    return $this->redirectToRoute('inventory-item-show', array('id' => $item->getId()));
                }
            }
            else // editing item
            {

            }
        }

        //var_dump($item);

        return $this->render('inventory/item_form.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'success' => $success,
            'error' => $error,
            'item' => $item
        ]);
    }

    public function deleteAction(Request $request, $id = '')
    {
        if($id !== '')
        {
            $entityManager = $this->getDoctrine()->getManager();
            $item = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.id = :id'
            )->setParameter('id', $id)->getOneOrNullResult();

            if($item)
            {
                $item->setDeleted(new \DateTime('now'));

                $entityManager->persist($item);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('inventory-show');
    }

    public function categoryAction(Request $request)
    {
        $error = '';
        $success = '';

        if($request->isMethod('post'))
        {
            $name = $request->request->get('name', '');

            if($name === '')
            {
                $error = 'Būtina įvesti pavadinimą';
            }
            else
            {
                $entityManager = $this->getDoctrine()->getManager();
                $category = new Category();
                $category->setName($name);
                $entityManager->persist($category);
                $entityManager->flush();

                $success = 'Kategorija sukurta';
            }
        }

        return $this->render('inventory/category.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'success' => $success,
            'error' => $error
        ]);
    }

    public function statusAction(Request $request)
    {
        $error = '';
        $success = '';

        if($request->isMethod('post'))
        {
            $name = $request->request->get('name', '');

            if($name === '')
            {
                $error = 'Būtina įvesti pavadinimą';
            }
            else
            {
                $entityManager = $this->getDoctrine()->getManager();
                $status = new Status();
                $status->setName($name);
                $entityManager->persist($status);
                $entityManager->flush();

                $success = 'Būsena sukurta';
            }
        }

        return $this->render('inventory/status.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'success' => $success,
            'error' => $error
        ]);
    }

    public function reportAction()
    {
        return $this->render('inventory/report.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
        ]);
    }

    private function getStatuses()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $statuses = $entityManager->createQuery(
            'SELECT s
            FROM AppBundle:Status s'
        )->getResult();

        return $statuses;
    }

    private function getCategories()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $categories = $entityManager->createQuery(
            'SELECT c
            FROM AppBundle:Category c'
        )->getResult();

        return $categories;
    }
}
