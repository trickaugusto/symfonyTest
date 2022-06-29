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
    * @Route("/product/{id}", name="product_show")
    */
    public function showOne(int $id): JsonResponse
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            return new JsonResponse(['message' => "No product found for id $id"], 404);
        }

        return new JsonResponse($product->getAllProperties());
    }

    /**
    * @Route("/product", name="create_product", methods={"POST"})
    */
    public function createProduct(ValidatorInterface $validator, ManagerRegistry $doctrine, Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $dadoJson = json_decode($corpoRequisicao);

        $entityManager = $doctrine->getManager();

        $product = new Product();
        $product->setStatus($dadoJson->status);
        $product->setPrice($dadoJson->price);
        $product->setDescription($dadoJson->description);

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/product/{id}", name="edit_product", methods={"PATCH"})
    */
    public function edit(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $dadoJson = json_decode($corpoRequisicao);

        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setStatus($dadoJson->status);
        $product->setPrice($dadoJson->price);
        $product->setDescription($dadoJson->description);

        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }
}