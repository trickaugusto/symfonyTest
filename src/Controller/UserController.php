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
    * @Route("/users", name="app_user", methods={"GET"})
    */
    public function getAll(): JsonResponse
    {
        $user = new UserService($this->getDoctrine()->getManager(), User::class);
                
        $user = $user->getAll();

        if (!$user) {
            return new JsonResponse(['message' => "There is no users created. First, create a user in the post route"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user, Response::HTTP_OK);
    }

    /**
    * @Route("/user/{id}", name="user_show", methods={"GET"})
    */
    public function getById(int $id): JsonResponse
    {
        $user = new UserService($this->getDoctrine()->getManager(), User::class);

        if (!$user->get($id)) {
            return new JsonResponse(['message' => "No user found for id $id"], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user->getOne($id));
    }

    /**
    * @Route("/user", name="create_user", methods={"POST"})
    */
    public function post(ManagerRegistry $doctrine, Request $request): Response
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);

        $user = new UserService($this->getDoctrine()->getManager(), User::class);
        $user->create($jsonData);

        return new JsonResponse(null, 204);
    }

    /**
    * @Route("/user/{id}", name="edit_user", methods={"PATCH"})
    */
    public function patch(ManagerRegistry $doctrine, int $id, Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $jsonData = json_decode($requestBody);
        
        $user = new UserService($this->getDoctrine()->getManager(), User::class);
        
        if (!$user->getOne($id)) {
            return new JsonResponse(['message' => "No user found for id $id"], Response::HTTP_NOT_FOUND);
        }
        
        $user->edit($id, $jsonData);

        return new JsonResponse($user->getOne($id));
    }
}