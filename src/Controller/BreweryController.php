<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BreweryController extends AbstractController
{

    /**
     * @Route("/brewery", name="brewery")
     */
    public function index(): Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        $ret = [];
        foreach ($customers as $customer) {
            $ret[] = [
                'name' => $customer->getName(),
                'email' => $customer->getEmail(),
                'phone' => $customer->getPhone(),
            ];
        }

        return $this->json($ret);
    }

    /**
     * @Route("/brew/{id}", name="brew")
     */
    public function show($id): Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        return $this->json(
            [
                'name' => $customer->getName(),
                'email' => $customer->getEmail(),
                'phone' => $customer->getPhone(),
            ]
        );


    }
}
