<?php
namespace App\Model;

class PDOMessageModel implements IMessageModel
{
    private $connection = null;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM messages');
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

    public function getById($messageId)
    {
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM messages WHERE id=?');
        $statement->bindValue(1, $messageId);
        $statement->execute();
        $statement->bindColumn(2, $content, \PDO::PARAM_STR);
        $statement->bindColumn(3, $category, \PDO::PARAM_STR);
        $statement->bindColumn(4, $date, \PDO::PARAM_STR);
        $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
        $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

        $messages = [];
        while($statement->fetch(\PDO::FETCH_BOUND)){
            $messages[] = ['id' => $messageId, 'content' => $content, 'category' => $category, 'date' => $date, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
        }
        return $messages;
    }

    public function searchByContent($search)
    {
        $statement = $this->connection->getPDO()->prepare("SELECT * FROM messages WHERE content LIKE ?");
        $statement->bindValue(1, "%" . $search . "%", \PDO::PARAM_STR);
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

    public function searchByContentAndCategory($search)
    {
        $statement = $this->connection->getPDO()->prepare("SELECT * FROM messages WHERE content LIKE ? OR  category LIKE ?");
        $statement->bindValue(1, "%" . $search . "%", \PDO::PARAM_STR);
        $statement->bindValue(2, "%" . $search . "%", \PDO::PARAM_STR);
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

    public function postComment($messageId, $comment)
    {
        $token = $this->generateToken();
        $statement = $this->connection->getPDO()->prepare("INSERT INTO comments (message_id, content, token) VALUES (?, ?, ?)");
        $statement->bindValue(1, $messageId, \PDO::PARAM_INT);
        $statement->bindValue(2, $comment, \PDO::PARAM_STR);
        $statement->bindValue(3, $token, \PDO::PARAM_STR);
        $statement->execute();

        return $token;
    }

    public function upVoteMessage($messageId)
    {
        // TODO: Implement upVoteMessage() method.
        $statement = $this->connection->getPDO()->prepare("UPDATE messages SET upvotes = upvotes + 1 WHERE id = ?");
        $statement->bindValue(1, $messageId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function downVoteMessage($messageId)
    {
        // TODO: Implement upVoteMessage() method.
        $statement = $this->connection->getPDO()->prepare("UPDATE messages SET downvotes = downvotes + 1 WHERE id = ?");
        $statement->bindValue(1, $messageId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    private function generateToken(){
        $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
        return $token;
    }
}