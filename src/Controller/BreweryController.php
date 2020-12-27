<?php

namespace App\Controller;

use App\Dto\Transformer\CustomerResponseDtoTransformer;
use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BreweryController extends AbstractController
{

    /**
     * @Route("/brewery", name="brewery")
     */
    public function index(CustomerResponseDtoTransformer $customerResponseDtoTransformer): Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        $dto = $customerResponseDtoTransformer->transformFromObjects($customers);

        return $this->json($dto);
    }

    /**
     * @Route("/brew/{id}", name="brew")
     */
    public function show(CustomerResponseDtoTransformer $customerResponseDtoTransformer, $id): Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        $dto = $customerResponseDtoTransformer->transformFromObject($customer);

        return $this->json($dto);
    }
}
