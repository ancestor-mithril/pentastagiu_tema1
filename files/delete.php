<?php
    define ('SLASH', DIRECTORY_SEPARATOR);
    define ('DIRECTOR_SITE', '.');
    require_once(DIRECTOR_SITE.SLASH."config.php");
    require_once(DIRECTOR_SITE.SLASH."database.php");

    function delete_book($id) {
        $db = DB::get_connection();
        $sql = "DELETE FROM `books` WHERE id=:id";
        $req = $db->prepare($sql);
        $req_params = [
            "id" => $id
        ];
        $req_status = $req->execute($req_params);
        $req_error = $req->errorInfo();
        if ($req_status === false) {
            echo "<pre>"; print_r($req_error); echo "</pre>"; die();
        }
    }

    if (isset($_POST["id"]))
        delete_book($_POST["id"]);
    else
        die("invalid request");
        
    header('Location: '.WSITE_ROOT.'/index.php');
    die();
?>