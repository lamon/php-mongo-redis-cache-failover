<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CustomersController extends Controller
{
    /**
     * @Route("/customers/")
     * @Method("GET")
     */
    public function getAction()
    {
        $cacheService = $this->get('cache_service');

        if ($cacheService->isOnline()) {
            // cache is online, trying to get customers
            $customers = json_decode($cacheService->get("customers"));

            if (!$customers) {
                // cache miss, fetch customers from database
                $customers = $this->fetchFromDatabase();

                if ($customers) {
                    // cache them
                    $cacheService->set("customers", json_encode($customers));
                }
            }
        } else {
            // cache is offline, hit the database
            $customers = $this->fetchFromDatabase();
        }

        return new JsonResponse($customers);
    }

    protected function fetchFromDatabase()
    {
        $database = $this->get('database_service')->getDatabase();
        $customers = $database->customers->find();
        return iterator_to_array($customers);
    }

    /**
     * @Route("/customers/")
     * @Method("POST")
     */
    public function postAction(Request $request)
    {
        $database = $this->get('database_service')->getDatabase();
        $customers = json_decode($request->getContent());

        if (empty($customers)) {
            return new JsonResponse(['status' => 'No donuts for you'], 400);
        }

        foreach ($customers as $customer) {
            $database->customers->insert($customer);
        }

        return new JsonResponse(['status' => 'Customers successfully created']);
    }

    /**
     * @Route("/customers/")
     * @Method("DELETE")
     */
    public function deleteAction()
    {
        $database = $this->get('database_service')->getDatabase();
        $database->customers->drop();

        $cacheService = $this->get('cache_service');
        if ($cacheService->isOnline()) {
            // delete from cache as well
            $cacheService->del("customers");
        }

        return new JsonResponse(['status' => 'Customers successfully deleted']);
    }
}
