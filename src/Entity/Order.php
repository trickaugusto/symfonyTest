<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="shop_order")
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class Order
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(type="string")
    */
    private $orderNumber;

    /**
    * @ORM\Column(type="string")
    */
    private $status;

    /**
    * @ORM\Column(type="integer")
    */
    private $productId;

    /**
    * @ORM\Column(type="string")
    */
    private $productDescription;

    /**
    * @ORM\Column(type="integer")
    */
    private $userId;

    /**
    * @ORM\Column(type="datetime")
    */
    private $createdAt;

    /**
    * @ORM\Column(type="datetime")
    */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    public function getProductDescription()
    {
        return $this->productDescription;
    }

    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}