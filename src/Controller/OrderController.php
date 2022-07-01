<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\OrderService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
    * @Route("/orders", name="app_orders", methods={"GET"})
    */
    public function showAll(): JsonResponse
    {
        $order = new OrderService($this->getDoctrine()->getManager(), Order::class);
                
        $order = $order->getAll();

        if (!$order) {
            return new JsonResponse(['message' => "There is no orders created. First, create a order in the post route"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($order, Response::HTTP_OK);
    }

    /**
    * @Route("/order/{id}", name="order_show", methods={"GET"})
    */
    public function showOne(int $id): JsonResponse
    {
        $order = new OrderService($this->getDoctrine()->getManager(), Order::class);

        if (!$order->get($id)) {
            return new JsonResponse(['message' => "No order found for id $id"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($order->getOne($id));
    }

    /**
    * @Route("/order", name="create_order", methods={"POST"})
    */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);

        $order = new OrderService($this->getDoctrine()->getManager(), Order::class);
        $result = $order->add($jsonData);

        if ($result == 'Product or user not found') {
            return new JsonResponse(['message' => $result], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/order/{id}", name="edit_order", methods={"PATCH"})
    */
    public function edit(ManagerRegistry $doctrine, int $id, Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);
        
        $order = new OrderService($this->getDoctrine()->getManager(), Order::class);
        
        if (!$order->getOne($id)) {
            return new JsonResponse(['message' => "No order found for id $id"], Response::HTTP_NOT_FOUND);
        }
        
        $order->edit($id, $jsonData);

        return new JsonResponse($order->getOne($id));
    }
}