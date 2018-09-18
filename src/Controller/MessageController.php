<?php

namespace App\Controller;

use App\Model\IMessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends Controller
{
    /**
     * MessageController constructor.
     */
    private $messageModel;

    /**
     * MessageController constructor.
     * @param $messageModel
     */
    public function __construct(IMessageModel $messageModel)
    {
        $this->messageModel = $messageModel;
    }


    /**
     * @Route("/message", name="message")
     */
    public function index()
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    /**
     * @Route("/messages", methods={"GET"}, name="getAll")
     */
    public function GetAll(){
        $statuscode = 200;
        $messages = [];
        try {
            $messages = $this->messageModel->GetAll();
        } catch (\PDOException $exception) {
            var_dump($exception);
            $statuscode = 500;
        }
        return new JsonResponse($messages, $statuscode);
    }



    public function GetById($messageId)
    {
        $statuscode = 200;
        $message = null;
        try {
            $message = $this->messageModel->GetById($messageId);
            if ($message == null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }
        return new JsonResponse($message, $statuscode);
    }

}
