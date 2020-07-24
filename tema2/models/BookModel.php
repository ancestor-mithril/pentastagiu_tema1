<?php
    class BookModel extends Model
    {
        public function __construct() {
            parent::__construct();
        }
        public function insertBook(array $params) {
            //$db = Database::getConnection();
            $title = $params["title"] ?? NULL;
            $authorId = $params["author_id"] ?? NULL;
            $publisherId = $params["publisher_id"] ?? NULL;
            $publisherYear = $params["publisher_year"] ?? NULL;

            $this->db->beginTransaction();

            //checking if there are any authors with the id $author_id
            $sql = "SELECT * FROM `authors` WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $authorId
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            if (empty ($answer)) {
                die ("Added book with non-existent author");
            }

            //checking if there are any publishers with the id $publishers_id
            $sql = "SELECT * FROM `publishers` WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $publisherId
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            if (empty ($answer)) {
                die ("Added book with non-existent publisher");
            }

            $sql = "INSERT INTO `books` VALUES (:id, :title, :author_id, :publisher_id, :publisher_year,
                 :created_at, :updated_at)";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => null,
                "title" => $title,
                "author_id" => $authorId,
                "publisher_id" => $publisherId,
                "publisher_year" => $publisherYear,
                "created_at" => date ("Y-m-d h:i:s"),
                "updated_at" => date ("Y-m-d h:i:s")
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $this->db->commit();
        }

        public function getAllBooks(): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `books`";
            $req = $this->db->prepare ($sql);
            $reqStatus = $req->execute();
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $book = $req->fetchAll (PDO::FETCH_ASSOC);
            
            $sql = "SELECT * FROM `authors` WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $book[0]["author_id"]
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);

            $book[0]["author_id"] = $answer[0]["name"] ?? NULL;
            
            $sql = "SELECT * FROM `publishers` WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $book[0]["publisher_id"]
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);

            $book[0]["publisher_id"] = $answer[0]["name"] ?? NULL;

            return $book;
        }

        public function deleteBook(int $id) {
            //$db = Database::getConnection();
            $sql = "DELETE FROM `books` WHERE id=:id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "id" => $id
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
        }

        public function getBook(int $id): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `books` where id=:id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "id" => $id
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            return $answer;
        }

        public function updateBook (array $params) {
            //$db = Database::getConnection();
            $title = $params["title"] ?? NULL;
            $authorId = $params["author_id"] ?? NULL;
            $publisherId = $params["publisher_id"] ?? NULL;
            $publisherYear = $params["publisher_year"] ?? NULL;
            $sql = "UPDATE `books` SET title=:title, author_id=:author_id, publisher_id=:publisher_id, 
                publisher_year=:publisher_year, updated_at=:updated_at WHERE id=:id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "title" => $title,
                "author_id" => $authorId,
                "publisher_id" => $publisherId,
                "publisher_year" => $publisherYear,
                "updated_at" => date ("Y-m-d h:i:s"),
                "id" => $params["id"],
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
        }

        public function getAllAuthors(): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `authors`";
            $req = $this->db->prepare ($sql);
            $reqStatus = $req->execute();
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            return $answer;
        }

        public function getAllPublishers(): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `publishers`";
            $req = $this->db->prepare ($sql);
            $reqStatus = $req->execute();
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            return $answer;
        }
    }