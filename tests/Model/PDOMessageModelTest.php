<?php

use PHPUnit\Framework\TestCase;

class PDOMessageModelTest extends TestCase {
    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory');
        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $this->connection->exec('CREATE TABLE messages(
          id INT,
          content LONGTEXT,
          category VARCHAR(100),
          date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          upvotes INT(10),
          downvotes INT(10),
          PRIMARY KEY (id)
        ),
        CREATE TABLE comments(
          id INT,
          message_id INT(11),
          content LONGTEXT,
          token VARCHAR(10),
          date TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )
        ');

        $messages = $this->providerMessages();
        foreach($messages as $message){
            $this->connection->exec("INSERT INTO messages (id, content, category, upvotes, downvotes)
                        VALUES (".$message['id'].", '".$message['content']."', '".$message['category']."',
                        ".$message['upvotes'].", ".$message['downvotes'].")");
        }
        $comments = $this->providerComments();
        foreach($comments as $comment){
            $this->connection->exec("INSERT INTO messages (id, message_id, content, token)
                        VALUES (".$message['id'].", ".$message['message_id'].", '".$message['content']."',
                        '".$message['token']."')");
        }
    }
    public function providerMessages()
    {
        return [['id' => 1, 'content' => $this->generateRandomString(), 'category' => $this->generateRandomString(), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)), 'upvotes' => mt_rand(0,5000), 'downvotes' => mt_rand(0,5000)],
            ['id' => 2, 'content' => $this->generateRandomString(), 'category' => $this->generateRandomString(), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)), 'upvotes' => mt_rand(0,5000), 'downvotes' => mt_rand(0,5000)],
            ['id' => 3, 'content' => $this->generateRandomString(), 'category' => $this->generateRandomString(), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)), 'upvotes' => mt_rand(0,5000), 'downvotes' => mt_rand(0,5000)]];
    }

    public function providerComments()
    {
        return [['id'=> 1,'message_id'=> 1, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 2,'message_id'=> 1, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 3,'message_id'=> 1, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 4,'message_id'=> 1, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 5,'message_id'=> 2, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 6,'message_id'=> 2, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 7,'message_id'=> 2, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 8,'message_id'=> 2, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 9,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 10,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 11,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 12,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 13,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))],
            ['id' => 14,'message_id'=> 3, 'content' => $this->generateRandomString(), 'token' => bin2hex(random_bytes(10)), 'date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681))]];
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
}