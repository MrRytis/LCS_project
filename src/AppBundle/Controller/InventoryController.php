<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Status;
use AppBundle\Entity\Item;
use AppBundle\Entity\ItemUse;
use AppBundle\Entity\LcsUser;
use AppBundle\Entity\Worker;

class InventoryController extends AbstractController
{
    public function indexAction(Request $request)
    {
        $search = $request->query->get('search', '');
        $statuses = $request->query->get('statuses', '');
        $categories = $request->query->get('categories', '');
        $entityManager = $this->getDoctrine()->getManager();
        $items = array();

        if($statuses !== '' && $categories !== '')
        {
            $items = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.deleted IS NULL AND (i.status IN(:statuses) OR i.category IN(:categories))'
            )->setParameter('statuses', $statuses)
            ->setParameter('categories', $categories)
            ->getResult();
        }
        else if($statuses !== '')
        {
            $items = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.deleted IS NULL AND i.status IN(:statuses)'
            )->setParameter('statuses', $statuses)
            ->getResult();
        }
        else if($categories !== '')
        {
            $items = $entityManager->createQuery(
                'SELECT i
                FROM AppBundle:Item i
                WHERE i.deleted IS NULL AND i.category IN(:categories)'
            )->setParameter('categories', $categories)
            ->getResult();
        }
        else if($search === '')
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

        $itemUse = $entityManager->createQuery(
            'SELECT u
            FROM AppBundle:ItemUse u
            WHERE u.item = :item AND u.returned IS NULL'
        )->setParameter('item', $item)->getOneOrNullResult();

        $user = '';
        if($itemUse)
        {
            $user = $itemUse->getWorker()->getAccount()->getName() . ' ' . $itemUse->getWorker()->getAccount()->getSurname();
        }

        return $this->render('inventory/item.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'item' => $item,
            'user' => $user
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

            $item = $foundItem;
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
                $name = $request->request->get('name', '');
                $price = $request->request->get('price', '');
                $categoryId = $request->request->get('category', '');
                $statusId = $request->request->get('status', '');

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

                    $editedItem = $entityManager->createQuery(
                        'SELECT i
                        FROM AppBundle:Item i
                        WHERE i.id = :id'
                    )->setParameter('id', $id)->getOneOrNullResult();

                    $selectedCategory = $this->getDoctrine()->getRepository(Category::class)->find($categoryId);
                    $selectedStatus = $this->getDoctrine()->getRepository(Status::class)->find($statusId);

                    $oldStatus = $editedItem->getStatus();

                    $editedItem->setName($name);
                    $editedItem->setValue($price);
                    $editedItem->setCategory($selectedCategory);
                    $editedItem->setStatus($selectedStatus);
                    
                    $entityManager->persist($editedItem);
                    $entityManager->flush();

                    if($oldStatus->getId() !== $selectedStatus->getId())
                    {
                        if($selectedStatus->getName() === 'Laisvas') // returning item
                        {
                            $itemUse = $entityManager->createQuery(
                                'SELECT i
                                FROM AppBundle:ItemUse i
                                WHERE i.returned IS NULL AND i.item = :itemid'
                            )->setParameter('itemid', $id)->getOneOrNullResult();

                            $itemUse->setReturned(new \DateTime('now'));

                            $entityManager->persist($itemUse);
                            $entityManager->flush();
                        }
                        else // take item for use
                        {
                            $worker = $entityManager->createQuery(
                                'SELECT w
                                FROM AppBundle:Worker w
                                WHERE w.account = :user'
                            )->setParameter('user', $this->getUser()->getId())->getOneOrNullResult();

                            $itemUse = new ItemUse();
                            $itemUse->setTaken(new \DateTime('now'));
                            $itemUse->setWorker($worker);
                            $itemUse->setItem($editedItem);

                            $entityManager->persist($itemUse);
                            $entityManager->flush();
                        }
                    }

                    return $this->redirectToRoute('inventory-item-show', array('id' => $editedItem->getId()));
                }
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
