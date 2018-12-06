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

    public function reportAction(Request $request)
    {
        $report = $request->query->get('type', 0);
        $year = $request->query->get('year', '2018');
        $month = $request->query->get('month', '12');
        $sum = 0;
        $lines = array();

        $entityManager = $this->getDoctrine()->getManager();

        switch($report)
        {
        case 1:
            $lines = $entityManager->createQuery(
                'SELECT u.name AS name, u.surname AS surname, COUNT(u.name) AS times
                FROM AppBundle:LcsUser u
                JOIN AppBundle:Worker w WITH u.id = w.account
                JOIN AppBundle:ItemUse i WITH w.id = i.worker
                GROUP BY u.name, u.surname
                ORDER BY times DESC'
            )->getResult();
            break;
        case 2:
            $lines = $entityManager->createQuery(
                'SELECT i.name AS name, c.name AS category, i.value AS value, i.added AS added, i.deleted
                FROM AppBundle:Item i
                JOIN AppBundle:Category c WITH i.category = c.id
                WHERE (i.added >= :start_date AND i.added <= :end_date) OR 
                (i.deleted >= :start_date AND i.deleted <= :end_date)'
            )->setParameter('start_date', $year . '-' . $month . '-01')
            ->setParameter('end_date', $year . '-' . $month . '-31')
            ->getResult();

            $add = $entityManager->createQuery(
                'SELECT SUM(i.value)
                FROM AppBundle:Item i
                WHERE i.added >= :start_date AND i.added <= :end_date'
            )->setParameter('start_date', $year . '-' . $month . '-01')
            ->setParameter('end_date', $year . '-' . $month . '-31')
            ->getResult();

            $substract = $entityManager->createQuery(
                'SELECT SUM(i.value)
                FROM AppBundle:Item i
                WHERE i.deleted >= :start_date AND i.deleted <= :end_date'
            )->setParameter('start_date', $year . '-' . $month . '-01')
            ->setParameter('end_date', $year . '-' . $month . '-31')
            ->getResult();

            $sum = floatval($add[0][1]) - floatval($substract[0][1]);
            break;
        case 3:
            $lines = $entityManager->createQuery(
                'SELECT i.name AS name, c.name AS category, 
                u.name AS username, u.surname AS usersurname, p.taken AS taken, i.value AS value
                FROM AppBundle:ItemUse p
                JOIN AppBundle:Item i WITH p.item = i.id
                JOIN AppBundle:Category c WITH i.category = c.id
                JOIN AppBundle:Worker w WITH p.worker = w.id
                JOIN AppBundle:LcsUser u WITH w.account = u.id
                WHERE p.returned IS NULL
                ORDER BY p.taken DESC'
            )->getResult();

            $sum = $entityManager->createQuery(
                'SELECT COUNT(p.id)
                FROM AppBundle:ItemUse p
                WHERE p.returned IS NULL'
            )->getResult();
            $sum = $sum[0][1];

            break;
        }

        return $this->render('inventory/report.html.twig', [
            'statuses' => $this->getStatuses(),
            'categories' => $this->getCategories(),
            'report' => $report,
            'lines' => $lines,
            'sum' => $sum
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
