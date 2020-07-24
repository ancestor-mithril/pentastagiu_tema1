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
            //TODO: check if authorId and publisherId do exist
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
            $answer = $req->fetchAll (PDO::FETCH_ASSOC);
            //TODO: get name of author and publisher
            return $answer;
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