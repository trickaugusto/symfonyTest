<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;

class ProductService extends AbstractService
{
    public function __construct(EntityManager $em, $entityName)
    {
        $this->em = $em;
        $this->model = $em->getRepository($entityName);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getProduct($productId)
    {
        return $this->find($productId);
    }

    public function getAllProducts()
    {
        $products = $this->findAll();

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'status' => $product->getStatus(),
                'price' => $product->getPrice(),
                'description' => $product->getDescription(),
            ];
        }

        return $data;
    }

    public function addProduct()
    {
        return $this->save();
    }

    public function deleteProduct($id)
    {   
        return $this->delete($this->find($id));
    }
}