<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
    * @Route("/products", name="app_product", methods={"GET"})
    */
    public function getAll(): JsonResponse
    {
        $products = new ProductService($this->getDoctrine()->getManager(), Product::class);
                
        $products = $products->getAll();

        if (!$products) {
            return new JsonResponse(['message' => "There is no products created. First, create a product in the post route"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($products, Response::HTTP_OK);
    }

    /**
    * @Route("/product/{id}", name="product_show", methods={"GET"})
    */
    public function getById(int $id): JsonResponse
    {
        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);

        if (!$product->getOne($id)) {
            return new JsonResponse(['message' => "No product found for id $id"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($product->getOne($id));
    }

    /**
    * @Route("/product", name="create_product", methods={"POST"})
    */
    public function post(ManagerRegistry $doctrine, Request $request): Response
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);

        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);
        $product->create($jsonData);

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/product/{id}", name="edit_product", methods={"PATCH"})
    */
    public function patch(ManagerRegistry $doctrine, int $id, Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);
        
        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);
        
        if (!$product->getOne($id)) {
            return new JsonResponse(['message' => "No product found for id $id"], Response::HTTP_NOT_FOUND);
        }
        
        $product->edit($id, $jsonData);

        return new JsonResponse($product->getOne($id));
    }
}