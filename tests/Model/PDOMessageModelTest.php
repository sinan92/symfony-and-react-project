<?php

use

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
          date TIMESTAMP,
          upvotes INT(10),
          downvotes INT(10),
          PRIMARY KEY (id)
        )
        CREATE TABLE comments(
          id INT,
          message_id INT(11),
          content LONGTEXT,
          token VARCHAR(10),
          date TIMESTAMP
        )
        ');

        $messages = $this->
    }
}