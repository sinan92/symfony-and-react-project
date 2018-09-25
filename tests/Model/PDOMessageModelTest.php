<?php

use PHPUnit\Framework\TestCase;
use Model\PDOMessageModel;
use Model\Connection;

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
        )
        ');

        $messages = $this->providerMessages();
        foreach($messages as $message){
            $this->connection->getPDO()->exec("INSERT INTO messages (id, content, category, upVotes, downVotes, `date`)
                        VALUES (".$message['id'].", '".$message['content']."', '".$message['category']."',
                        ".$message['upVotes'].", ".$message['downVotes'].", '".$message['date']."')");
        }
        $comments = $this->providerComments();
        foreach($comments as $comment){
            $this->connection->getPDO()->exec("INSERT INTO comments (id, message_id, content, token)
                        VALUES (".$comment['id'].", ".$comment['message_id'].", '".$comment['content']."',
                        '".$comment['token']."')");
        }
    }

    public function providerMessages()
    {
        return [
            ['id' => 1, 'content' => 'Test', 'category' => 'Comedy', 'date' => date("Y-m-d H:i:s", mktime(3, 0, 0, 7, 1, 2000)), 'upVotes' => 10, 'downVotes' => 30],
            ['id' => 2, 'content' => 'Test2', 'category' => 'Horror', 'date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 2, 1, 2000)), 'upVotes' => 20, 'downVotes' => 20],
            ['id' => 3, 'content' => 'Test3', 'category' => 'Thriller', 'date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 10, 30, 2010)), 'upVotes' => 30, 'downVotes' => 10]
        ];
    }

    public function providerComments()
    {
        return [['id'=> 1,'message_id'=> 1, 'content' => "Content1", 'token' => 10001001, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 2,'message_id'=> 1, 'content' => "Content2", 'token' => 10001011, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 3,'message_id'=> 1, 'content' => "Content3", 'token' => 10001100, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 4,'message_id'=> 1, 'content' => "Content4", 'token' => 10001010, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 5,'message_id'=> 2, 'content' => "Content5", 'token' => 10001000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 6,'message_id'=> 2, 'content' => "Content6", 'token' => 10101000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 7,'message_id'=> 2, 'content' => "Content7", 'token' => 10001010, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 8,'message_id'=> 2, 'content' => "Content8", 'token' => 10001000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 9,'message_id'=> 3, 'content' => "Content9", 'token' => 10001010, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 10,'message_id'=> 3, 'content' => "Content10", 'token' => 10001000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 11,'message_id'=> 3, 'content' => "Content11", 'token' => 10001100, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 12,'message_id'=> 3, 'content' => "Content12", 'token' => 10011000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 13,'message_id'=> 3, 'content' => "Content13", 'token' => 10101000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")],
            ['id' => 14,'message_id'=> 3, 'content' => "Content14", 'token' => 11001000, 'date' => date("Y-m-d H:i:s", "2000-05-13 12:25:33")]];
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function testGetById_messagesInDatabase(){
        $messagesModel = new PDOMessageModel($this->connection);
        $actualMessage = $messagesModel->getById(1);
        $expectedMessage = $this->providerMessages();
        $this->assertEquals('array', gettype($actualMessage));
        $this->assertEquals($expectedMessage[0], $actualMessage[0]);
    }
}