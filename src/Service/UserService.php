<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserService extends AbstractService
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

    public function getUser($userId)
    {
        return $this->find($userId);
    }

    public function getAllUsers()
    {
        $users = $this->findAll();

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'status' => $user->getStatus(),
                'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $user->getUpdatedAt()->format('Y-m-d H:i:s')
            ];
        }

        return $data;
    }

    public function getOneUser($userId)
    {
        $user = $this->find($userId);

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'status' => $user->getStatus(),
            'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $user->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public function addUser($jsonData)
    {
        $user = new User();
        $user->setName($jsonData->name);
        $user->setEmail($jsonData->email);
        $user->setStatus($jsonData->status);
        
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        
        return $this->save($user);
    }

    public function editUser($id, $jsonData)
    {
        $user = $this->find($id);

        $user->setName($jsonData->name);        
        $user->setEmail($jsonData->email);
        $user->setStatus($jsonData->status);

        $user->setDescription($jsonData->description);
        $user->setUpdatedAt(new \DateTime());
        
        return $this->update();
    }

    public function deleteUser($id)
    {   
        return $this->delete($this->find($id));
    }
}