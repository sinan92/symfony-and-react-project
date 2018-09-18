<?php 
namespace App\Model;

interface IMessageModel {
    public function GetAll();
    public function GetById($messageId);
    public function searchByContent($search);
    public function searchByContentAndCategory($search);
    public function postComment($messageId, $comment);
    public function upVoteMessage($messageId);
    public function downVoteMessage($messageId);
}