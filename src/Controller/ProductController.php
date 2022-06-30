<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
    * @Route("/product", name="app_product", methods={"GET"})
    */
    public function showAll(): JsonResponse
    {
        $products = new ProductService($this->getDoctrine()->getManager(), Product::class);
                
        $products = $products->getAllProducts();

        return new JsonResponse($products, Response::HTTP_OK);
    }

    /**
    * @Route("/product/{id}", name="product_show", methods={"GET"})
    */
    public function showOne(int $id): JsonResponse
    {
        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);

        if (!$product->getProduct($id)) {
            return new JsonResponse(['message' => "No product found for id $id"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($product->getOneProduct($id));
    }

    /**
    * @Route("/product", name="create_product", methods={"POST"})
    */
    public function createProduct(ManagerRegistry $doctrine, Request $request): Response
    {
        // pega dados da requisição
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);

        // instancia um novo produto e adiciona no banco
        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);
        $product->addProduct($jsonData);

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/product/{id}", name="edit_product", methods={"PATCH"})
    */
    public function edit(ManagerRegistry $doctrine, int $id, Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);
        
        $product = new ProductService($this->getDoctrine()->getManager(), Product::class);
        
        if (!$product->getOneProduct($id)) {
            return new JsonResponse(['message' => "No product found for id $id"], Response::HTTP_NOT_FOUND);
        }
        
        $product->editProduct($id, $jsonData);

        return new JsonResponse($product->getOneProduct($id));
    }
}