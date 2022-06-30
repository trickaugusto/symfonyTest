<?php

namespace App\Service;

use App\Entity\Product;
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
                'createdAt' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $product->getUpdatedAt()->format('Y-m-d H:i:s')
            ];
        }

        return $data;
    }

    public function getOneProduct($productId)
    {
        $product = $this->find($productId);

        return [
            'id' => $product->getId(),
            'status' => $product->getStatus(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
            'createdAt' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $product->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public function addProduct($jsonData)
    {
        $product = new Product();
        $product->setStatus($jsonData->status);
        $product->setPrice($jsonData->price);
        $product->setDescription($jsonData->description);
        $product->setCreatedAt(new \DateTime());
        $product->setUpdatedAt(new \DateTime());
        
        return $this->save($product);
    }

    public function editProduct($id, $jsonData)
    {
        $product = $this->find($id);

        $product->setStatus($jsonData->status);        
        $product->setPrice($jsonData->price);
        $product->setDescription($jsonData->description);
        $product->setUpdatedAt(new \DateTime());
        
        return $this->update();
    }

    public function deleteProduct($id)
    {   
        return $this->delete($this->find($id));
    }
}