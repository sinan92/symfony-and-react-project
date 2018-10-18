<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends Controller
{
    // Rechten:
    // Als ik praat over een poster, dan heeft de modarator natuurlijk ook de rechten om die functie uit te voeren
    // maar een anonieme gebruiker niet. 

    // moderator only
    public function deleteAllMessagesFromPoster()
    {

    }

    //Moderator kan alleen categorieen posten
    public function postCategory()
    {

    }

    // Anonieme gebruikers kunnen zoeken in messages
    public function getMessage($id)
    {

    }

    // anonieme gebruikers
    // we moeten gebruik maken van paginatie.
    public function getMessages()
    {

    }

    // posters kunnen berichten aanmaken in bestaande categorie
    public function postMessage()
    {

    }

    // poster kan alleen eigen message updaten
    public function updateMessage()
    {

    }

    // poster kan alleen eigen message deleten
    public function deleteMessage()
    {

    }

    // anoniem
    // link naar message
    // Bij het aanmaken krijgt de gebruiker het token en id van de reactie.
    public function postComment()
    {

    }

    //De gebruiker kan wijzigen en verwijderen adhv het
    //token dat hoort bij het bericht 1pt
    public function updateComment()
    {

    }

    //De gebruiker kan wijzigen en verwijderen adhv het
    //token dat hoort bij het bericht 1pt
    public function deleteComment()
    {

    }
}
