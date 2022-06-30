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

    public function get($userId)
    {
        return $this->find($userId);
    }

    public function getAll()
    {
        $users = $this->findAll();

        if(!$users){
            return false;
        }

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

    public function getOne($userId)
    {
        $user = $this->find($userId);

        if(!$user){
            return false;
        }

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'status' => $user->getStatus(),
            'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $user->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public function add($jsonData)
    {
        $user = new User();
        $user->setName($jsonData->name);
        $user->setEmail($jsonData->email);
        $user->setStatus($jsonData->status);
        
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        
        return $this->save($user);
    }

    public function edit($id, $jsonData)
    {
        $user = $this->find($id);

        $user->setName($jsonData->name);        
        $user->setEmail($jsonData->email);
        $user->setStatus($jsonData->status);

        $user->setUpdatedAt(new \DateTime());
        
        return $this->update();
    }

    public function delete($id)
    {   
        return $this->delete($this->find($id));
    }
}