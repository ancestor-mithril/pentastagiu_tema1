<?php
    class BookModel extends Model
    {
        public function __construct() {
            parent::__construct();
        }
        public function insertBook($params) {
            //$db = Database::getConnection();
            $title = $params["title"] ?? NULL;
            $authorName = $params["author_name"] ?? NULL;
            $publisherName = $params["publisher_name"] ?? NULL;
            $publisherYear = $params["publisher_year"] ?? NULL;
            $sql = "INSERT INTO `books` VALUES (:id, :title, :author_name, :publisher_name, :publisher_year,
                 :created_at, :updated_at)";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => null,
                "title" => $title,
                "author_name" => $authorName,
                "publisher_name" => $publisherName,
                "publisher_year" => $publisherYear,
                "created_at" => date("Y-m-d h:i:s"),
                "updated_at" => date("Y-m-d h:i:s")
            ];
            $reqStatus = $req->execute($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
        }

        public function getAllBooks(): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `books`";
            $req = $this->db->prepare($sql);
            $reqStatus = $req->execute();
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll(PDO::FETCH_ASSOC);
            return $answer;
        }

        public function deleteBook($id) {
            //$db = Database::getConnection();
            $sql = "DELETE FROM `books` WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $id
            ];
            $reqStatus = $req->execute($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
        }

        public function getBook($id) {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `books` where id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "id" => $id
            ];
            $reqStatus = $req->execute($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
            $answer = $req->fetchAll(PDO::FETCH_ASSOC);
            return $answer;
        }

        public function updateBook ($params) {
            //$db = Database::getConnection();
            $title = $params["title"] ?? NULL;
            $authorName = $params["author_name"] ?? NULL;
            $publisherName = $params["publisher_name"] ?? NULL;
            $publisherYear = $params["publisher_year"] ?? NULL;
            $sql = "UPDATE `books` SET title=:title, author_name=:author_name, publisher_name=:publisher_name, 
                publisher_year=:publisher_year, updated_at=:updated_at WHERE id=:id";
            $req = $this->db->prepare($sql);
            $reqParams = [
                "title" => $title,
                "author_name" => $authorName,
                "publisher_name" => $publisherName,
                "publisher_year" => $publisherYear,
                "updated_at" => date("Y-m-d h:i:s"),
                "id" => $params["id"],
            ];
            $reqStatus = $req->execute($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r($reqError); echo "</pre>"; die();
            }
        }
    }