<?php 
namespace Model;

interface IMessageModel {
    public function getAll();
    public function getById($messageId);
    public function searchByContent($search);
    public function searchByContentAndCategory($search);
    public function postComment($messageId, $comment);
    public function upVoteMessage($messageId);
    public function downVoteMessage($messageId);
}