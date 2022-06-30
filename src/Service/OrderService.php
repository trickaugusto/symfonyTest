<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Order;
use App\Entity\Product;
use App\Service\UserService;
use App\Service\ProductService;
use Doctrine\ORM\EntityManager;
use App\Controller\ProductController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderService extends AbstractService
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

    public function get($orderId)
    {
        return $this->find($orderId);
    }

    public function getAll()
    {
        $orders = $this->findAll();

        if(!$orders){
            return false;
        }

        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->getId(),
                'orderNumber' => $order->getOrderNumber(),
                'status' => $order->getStatus(),
                'productId' => $order->getProductId(),
                'productDescription' => $order->getProductDescription(),
                'userId' => $order->getUserId(),
                'createdAt' => $order->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $order->getUpdatedAt()->format('Y-m-d H:i:s')
            ];
        }

        return $data;
    }

    public function getOne($orderId)
    {
        $order = $this->find($orderId);

        if(!$order){
            return false;
        }

        return [
            'id' => $order->getId(),
            'orderNumber' => $order->getOrderNumber(),
            'status' => $order->getStatus(),
            'productId' => $order->getProductId(),
            'productDescription' => $order->getProductDescription(),
            'userId' => $order->getUserId(),
            'createdAt' => $order->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $order->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public function add($jsonData)
    {
        $product = new ProductService($this->em, Product::class);
        $user = new UserService($this->em, User::class);

        $productId = $jsonData->productId;
        $userId = $jsonData->userId;

        if (!$product->getOne($productId) || !$user->getOne($userId)) return 'Product or user not found';

        $order = new Order();
        $order->setStatus($jsonData->status);
        $order->setProductId($productId);
        $order->setUserId($jsonData->userId);

        $order->setOrderNumber(
            md5($productId . $jsonData->userId)
        );
        
        // get product description
        $order->setProductDescription($product->getOne($productId)['description']); 
        
        $order->setCreatedAt(new \DateTime());
        $order->setUpdatedAt(new \DateTime());
        
        return $this->save($order);
    }

    public function edit($id, $jsonData)
    {
        $order = $this->find($id);

        $order->setStatus($jsonData->status);
        $order->setProductId($jsonData->productId);
        $order->setUserId($jsonData->userId);

        $order->setUpdatedAt(new \DateTime());
        
        return $this->update();
    }

    public function delete($id)
    {   
        return $this->delete($this->find($id));
    }
}