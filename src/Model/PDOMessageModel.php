<?php
namespace App\Model;

class PDOMessageModel implements IMessageModel
{
    private $connection = null;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function GetAll()
    {
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM message');
        $statement->execute();
        $statement->bindColumn(1, $id, \PDO::PARAM_INT);
        $statement->bindColumn(2, $content, \PDO::PARAM_STR);
        $statement->bindColumn(3, $category, \PDO::PARAM_STR);
        $statement->bindColumn(4, $date, \PDO::PARAM_INT);
        $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
        $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

        $messages = [];
        while($statement->fetch(\PDO::FETCH_BOUND)){
            $messages[] = ['id' => $id, 'content' => $content, 'category' => $category, 'date' => $date, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
        }
        return $messages;
    }

    public function GetById($messageId)
    {

    }

    public function searchByContent($search)
    {
        // TODO: Implement searchByContent() method.
    }

    public function searchByContentAndCategory($search)
    {
        // TODO: Implement searchByContentAndCategory() method.
    }

    public function postComment($messageId, $comment)
    {
        // TODO: Implement postComment() method.
    }

    public function upVoteMessage($messageId)
    {
        // TODO: Implement upVoteMessage() method.
    }

    public function downVoteMessage($messageId)
    {
        // TODO: Implement downVoteMessage() method.
    }
}