<?php
    define ('SLASH', DIRECTORY_SEPARATOR);
    define ('DIRECTOR_SITE', '.');
    require_once(DIRECTOR_SITE.SLASH."config.php");
    require_once(DIRECTOR_SITE.SLASH."database.php");

    function get_book($id) {
        $db = DB::get_connection();
        $sql = "SELECT * FROM `books` where id=:id";
        $req = $db->prepare($sql);
        $req_params = [
            "id" => $id
        ];
        $req_status = $req->execute($req_params);
        $req_error = $req->errorInfo();
        if ($req_status === false) {
            echo "<pre>"; print_r($req_error); echo "</pre>"; die();
        }
        $answer = $req->fetchAll(PDO::FETCH_ASSOC);

        return $answer;
    }

    function create_form($book) :string {
        $formular = "<form action=\"update.php\" method=\"POST\">";
        $formular .= '<label for="title">Title:</label><br>';
        $formular .= '<input type="hidden" id="id" name="id" value="'.$book["id"].'"><br>';
        $formular .= '<input type="text" id="title" name="title" value="'.$book["title"].'"><br>';
        $formular .= '<label for="author_name">Author:</label><br>';
        $formular .= '<input type="text" id="author_name" name="author_name" value="'.$book["author_name"].'"><br>';
        $formular .= '<label for="publisher_name">Publisher:</label><br>';
        $formular .= '<input type="text" id="publisher_name" name="publisher_name" value="'
            .$book["publisher_name"].'"><br>';
        $formular .= '<label for="publisher_year">Year:</label><br>';
        $formular .= '<input type="number" id="publisher_year" name="publisher_year" value="'
            .$book["publisher_year"].'"><br><br>';
        $formular .= '<input type="submit" value="Submit"><br>';
        $formular .= "</form>";
        return $formular;
    }

    function display_book() {
        $book = get_book($_GET["id"]);
        if (empty($book))
            die("error at parsing request");
        echo create_form($book[0]);
    }
    
    //echo "<pre>"; print_r($_GET); echo "</pre>"; die();
    if (isset($_GET["id"]))
        display_book();
    else
        die("invalid request");
    
