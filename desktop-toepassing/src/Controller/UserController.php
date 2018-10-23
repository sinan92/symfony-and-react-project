<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //Alleen administrator kan moderaters en posters maken
    public function postUser(User $user)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }

    //Alleen administrator kan moderaters en posters maken
    public function updateUser(int $id, string $username, string $password, string $roleString)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user =  $entityManager->getRepository(user::class)->find($id);
        if (!$user)
        {
            throw $this->createNotFoundException(
                'No message found for id '.$id
            );
        }
        $user->setUserName($username);
        $user->setPassword($password);
        $user->setRoleString($roleString);
        $entityManager->flush();
    }

    //Alleen administrator kan moderaters en posters maken
    public function deleteUser(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('appBundle:Message')->find($id);
        if (!$user)
        {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $entityManager->remove($user);
        $entityManager->flush();
    }
}