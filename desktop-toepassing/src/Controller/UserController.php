<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //Alleen administrator kan moderaters en posters maken
    public function postUser(Request $request)
    {

    }

    //Alleen administrator kan moderaters en posters maken
    public function updateUser(Request $request)
    {

    }

    //Alleen administrator kan moderaters en posters maken
    public function deleteUser(Request $request)
    {

    }
}