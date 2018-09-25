<?php

use PHPUnit\Framework\TestCase;
use App\Model\PDOMessageModel;
use App\Model\Connection;

class PDOMessageModelTest extends TestCase {
    public function setUp()
    {
        $this->connection = new Connection('sqlite::memory:');

        $this->connection->getPDO()->exec('CREATE TABLE messages(
          id INT,
          content LONGTEXT,
          category VARCHAR(100),
          date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          upVotes INT(10),
          downVotes INT(10),
          PRIMARY KEY (id)
        );
        CREATE TABLE comments(
          id INT,
          message_id INT(11),
          content LONGTEXT,
          token VARCHAR(10),
          date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (id)
        );
        ');

        $messages = $this->providerMessages();
        foreach($messages as $message){
            $this->connection->getPDO()->exec("INSERT INTO messages (id, content, category, upVotes, downVotes, `date`)
                        VALUES (".$message['id'].", '".$message['content']."', '".$message['category']."',
                        ".$message['upVotes'].", ".$message['downVotes'].", '".$message['date']."')");
        }
    }

    protected function tearDown()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->connection = null;
    }

    public function providerMessages()
    {
        return [
            ['id' => 1, 'content' => 'Test', 'category' => 'Comedy', 'date' => date("Y-m-d H:i:s", mktime(3, 0, 0, 7, 1, 2000)), 'upVotes' => 10, 'downVotes' => 30],
            ['id' => 2, 'content' => 'Test2', 'category' => 'Horror', 'date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 2, 1, 2000)), 'upVotes' => 20, 'downVotes' => 20],
            ['id' => 3, 'content' => 'Test3', 'category' => 'Thriller', 'date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 10, 30, 2010)), 'upVotes' => 30, 'downVotes' => 10]
        ];
    }

    public function testGetById_messagesInDatabase(){
        //Comments ophalen uit sqlite database
        $messagesModel = new PDOMessageModel($this->connection);
        $actualMessage = $messagesModel->getById(1);

        $expectedMessage = $this->providerMessages();
        $this->assertEquals('array', gettype($actualMessage));
        $this->assertEquals($expectedMessage[0], $actualMessage[0]);
    }

    public function testPostComment_commentInDatabase(){
        //Comment posten in sqlite database
        $messagesModel = new PDOMessageModel($this->connection);
        $actualMessage = $messagesModel->postComment(10, 'Hello');

        //Comments uit de database ophalen
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM comments WHERE message_id = 10');
        $statement->execute();
        $comments = $statement->fetch();


        $expectedMessage = $comments['token'];
        $this->assertEquals('string', gettype($actualMessage));
        $this->assertEquals($expectedMessage, $actualMessage);
    }

}