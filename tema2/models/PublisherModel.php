<?php
    class PublisherModel extends Model
    {
        public function __construct() {
            parent::__construct();
        }
        public function insertPublisher (array $params) {
            //$db = Database::getConnection();
            $name = $params["name"] ?? NULL;
            $sql = "INSERT INTO `publishers` VALUES (:id, :name, :created_at, :updated_at)";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "id" => null,
                "name" => $name,
                "created_at" => date("Y-m-d h:i:s"),
                "updated_at" => date("Y-m-d h:i:s")
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) 
            {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
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

        public function deletePublisher(int $id) {
            //$db = Database::getConnection();
            $this->db->beginTransaction();
            $sql = "DELETE FROM `publishers` WHERE id=:id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "id" => $id
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $sql = "DELETE FROM `books` where publisher_id=:publisher_id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "publisher_id" => $id
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
            $this->db->commit();
        }

        public function getPublisher(int $id): array {
            //$db = Database::getConnection();
            $sql = "SELECT * FROM `publishers` where id=:id";
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

        public function updatePublisher (array $params) {
            //$db = Database::getConnection();
            $name = $params["name"] ?? NULL;
            $sql = "UPDATE `publishers` SET name=:name, updated_at=:updated_at WHERE id=:id";
            $req = $this->db->prepare ($sql);
            $reqParams = [
                "name" => $name,
                "updated_at" => date ("Y-m-d h:i:s"),
                "id" => $params["id"],
            ];
            $reqStatus = $req->execute ($reqParams);
            $reqError = $req->errorInfo();
            if ($reqStatus === false) {
                echo "<pre>"; print_r ($reqError); echo "</pre>"; die();
            }
        }
    }