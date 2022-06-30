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

    public function get($productId)
    {
        return $this->find($productId);
    }

    public function getAll()
    {
        $products = $this->findAll();

        if(!$products){
            return false;
        }

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

    public function getOne($productId)
    {
        $product = $this->find($productId);

        if(!$product){
            return false;
        }

        return [
            'id' => $product->getId(),
            'status' => $product->getStatus(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
            'createdAt' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $product->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public function add($jsonData)
    {
        $product = new Product();
        $product->setStatus($jsonData->status);
        $product->setPrice($jsonData->price);
        $product->setDescription($jsonData->description);
        $product->setCreatedAt(new \DateTime());
        $product->setUpdatedAt(new \DateTime());
        
        return $this->save($product);
    }

    public function edit($id, $jsonData)
    {
        $product = $this->find($id);

        $product->setStatus($jsonData->status);        
        $product->setPrice($jsonData->price);
        $product->setDescription($jsonData->description);
        $product->setUpdatedAt(new \DateTime());
        
        return $this->update();
    }

    public function delete($id)
    {   
        return $this->delete($this->find($id));
    }
}