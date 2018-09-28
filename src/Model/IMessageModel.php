<?php
namespace App\Model;

interface IMessageModel
{
    public function getAll();
    public function getById($messageId);
    public function searchByContent($search);
    public function searchByCategory($category);
    public function searchByContentAndCategory($content, $category);
    public function postComment($messageId, $comment);
    public function upVoteMessage($messageId);
    public function downVoteMessage($messageId);
}
