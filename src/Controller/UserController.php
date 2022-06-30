<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
    * @Route("/user", name="app_user", methods={"GET"})
    */
    public function showAll(): JsonResponse
    {
        $user = new UserService($this->getDoctrine()->getManager(), User::class);
                
        $user = $user->getAllUsers();

        return new JsonResponse($user, Response::HTTP_OK);
    }

    /**
    * @Route("/user/{id}", name="user_show", methods={"GET"})
    */
    public function showOne(int $id): JsonResponse
    {
        $user = new UserService($this->getDoctrine()->getManager(), User::class);

        if (!$user->getUser($id)) {
            return new JsonResponse(['message' => "No user found for id $id"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user->getOneUser($id));
    }

    /**
    * @Route("/user", name="create_user", methods={"POST"})
    */
    public function createUser(ManagerRegistry $doctrine, Request $request): Response
    {
        // pega dados da requisição
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);

        // instancia um novo user e adiciona no banco
        $user = new UserService($this->getDoctrine()->getManager(), User::class);
        $user->addUser($jsonData);

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/user/{id}", name="edit_user", methods={"PATCH"})
    */
    public function edit(ManagerRegistry $doctrine, int $id, Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);
        
        $user = new UserService($this->getDoctrine()->getManager(), User::class);
        
        if (!$user->getOneUser($id)) {
            return new JsonResponse(['message' => "No user found for id $id"], Response::HTTP_NOT_FOUND);
        }
        
        $user->editUser($id, $jsonData);

        return new JsonResponse($user->getOneUser($id));
    }
}