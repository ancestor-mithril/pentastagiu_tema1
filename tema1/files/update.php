<?php
    define ('SLASH', DIRECTORY_SEPARATOR);
    define ('DIRECTOR_SITE', '.');
    require_once(DIRECTOR_SITE.SLASH."config.php");
    require_once(DIRECTOR_SITE.SLASH."database.php");

    function edit_book($params) {
        $db = DB::get_connection();
        $title = $params["title"] ?? NULL;
        $author_name = $params["author_name"] ?? NULL;
        $publisher_name = $params["publisher_name"] ?? NULL;
        $publisher_year = $params["publisher_year"] ?? NULL;
        $sql = "UPDATE `books` SET title=:title, author_name=:author_name, publisher_name=:publisher_name, 
            publisher_year=:publisher_year, updated_at=:updated_at WHERE id=:id";
        $req = $db->prepare($sql);
        $req_params = [
            "title" => $title,
            "author_name" => $author_name,
            "publisher_name" => $publisher_name,
            "publisher_year" => $publisher_year,
            "updated_at" => date("Y-m-d h:i:s"),
            "id" => $params["id"],
        ];
        $req_status = $req->execute($req_params);
        $req_error = $req->errorInfo();
        if ($req_status === false) {
            echo "<pre>"; print_r($req_error); echo "</pre>"; die();
        }
    }

    if (isset($_POST["id"]))
        edit_book($_POST);
    else
        die("invalid request");
        
    header('Location: '.WSITE_ROOT.'/index.php');
    die();
