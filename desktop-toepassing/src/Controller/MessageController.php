<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Category;
use App\Entity\Comment;
use App\Form\CommentForm;
use App\Entity\User;
use App\Form\MessageForm;
use App\Form\MessageSearchForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class MessageController extends Controller
{
    // Rechten:
    // Als ik praat over een poster, dan heeft de modarator natuurlijk ook de rechten om die functie uit te voeren
    // maar een anonieme gebruiker niet.

    // moderator only
    public function deleteAllMessagesFromPoster(string $user)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $messages = $entityManager->getRepository('appBundle:Message')->findBy(array('name' => $user));
        if (!$messages)
        {
            throw $this->createNotFoundException(
                'No messages found for user ' .$user
            );
        }
        foreach ($messages as $message)
        {
            $entityManager->remove($message);
        }
        $entityManager->flush();
    }

    //Moderator kan alleen categorieen posten
    public function postCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();
        return new Response('Saved new Category ' . $category);
    }

    // Anonieme gebruikers kunnen zoeken in messages
    /**
     * @Route("/message/find", name="getById")
     */
    public function getMessage(Request $request)
    {
        $id=$request->get("id");
        $message = $this->getDoctrine()->getManager()->getRepository(Message::class)->find($id);
        $messages = array($message);
        return $this->render('message/index.html.twig', array('messages' => $messages,
            'controller_name' => 'Message Controller'));
    }

    // anonieme gebruikers
    // we moeten gebruik maken van paginatie.
    /**
     * @Route("/message/getAll", name="getAllMessages")
     */
    public function getMessages(Request $request, PaginatorInterface $paginator)
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentForm::class, $comment);
        $category = new Category();
        $messageSearchForm = $this->createForm(MessageSearchForm::class, $category);

        $messagesRepository = $this->getDoctrine()->getManager()->getRepository(Message::class);
        $queryBuilder = $messagesRepository->createQueryBuilder('p')->getQuery();

        //paginatie
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('message/index.html.twig', array(
            'messageSearchFormObject' => $messageSearchForm,
            'commentFormObject' => $commentForm,
            'messages' => $pagination,
            'controller_name' => 'Message Controller'));
    }

    // posters kunnen berichten aanmaken in bestaande categorie
    /**
     * @Route("/message/post", name="postMessage")
     */
    public function postMessage(Request $request)
    {
        $message = new Message;
        $message->setContent("TestContent");
        $user = new User();
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(1);
        $message->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();
        return new Response('Saved new Message ' . $message);
    }

    // poster kan alleen eigen message updaten
    public function updateMessage(int $id, string $newContent, Category $newCategory)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $message =  $entityManager->getRepository(message::class)->find($id);
        if (!$message)
        {
            throw $this->createNotFoundException(
                'No message found for id ' . $id
            );
        }
        $message->setContent($newContent);
        $message->setCategory($newCategory);
        $entityManager->flush();
    }

    // poster kan alleen eigen message deleten
    public function deleteMessage(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository('appBundle:Message')->find($id);
        if (!$message)
        {
            throw $this->createNotFoundException(
                'No message found for id '.$id
            );
        }
        $entityManager->remove($message);
        $entityManager->flush();
    }

    // anoniem
    // link naar message
    // Bij het aanmaken krijgt de gebruiker het token en id van de reactie.
    /**
     * @Route("/message/comment/post", name="formComment")
     */
    public function postComment(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentForm::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager()->getRepository(Comment::class);
            $datetime = new DateTime();
            $comment->setDate(date('Y-m-d H:i:s'));
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('/message/getAll');
        }
    }

    //De gebruiker kan wijzigen en verwijderen adhv het
    //token dat hoort bij het bericht 1pt
    public function updateComment(int $id, string $newContent)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment =  $entityManager->getRepository(Comment::class)->find($id);
        if (!$comment)
        {
            throw $this->createNotFoundException(
                'No comment found for id ' . $id
            );
        }
        $comment->setContent($newContent);
        $entityManager->flush();
    }

    //De gebruiker kan wijzigen en verwijderen adhv het
    //token dat hoort bij het bericht 1pt
    public function deleteComment(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager->getRepository('appBundle:Comment')->find($id);
        if (!$comment)
        {
            throw $this->createNotFoundException(
                'No comment found for id '.$id
            );
        }
        $entityManager->remove($comment);
        $entityManager->flush();
    }
}
