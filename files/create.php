<?php
    function get_all_books(){
        $db = DB::get_connection();
        $sql = "SELECT * FROM `books`";
        $req = $db->prepare($sql);
        $req_status = $req->execute();
        $req_error = $req->errorInfo();
        if ($req_status === false) {
            echo "<pre>"; print_r($req_error); echo "</pre>"; die();
        }
        $answer = $req->fetchAll(PDO::FETCH_ASSOC);

        return $answer;
    }

    function create_formular() :string {
        $formular = "<form action=\"files/store.php\" method=\"POST\">";
        $formular .= '<label for="title">Title:</label><br>';
        $formular .= '<input type="text" id="title" name="title" value="default title"><br>';
        $formular .= '<label for="author_name">Author:</label><br>';
        $formular .= '<input type="text" id="author_name" name="author_name" value="default author"><br>';
        $formular .= '<label for="publisher_name">Publisher:</label><br>';
        $formular .= '<input type="text" id="publisher_name" name="publisher_name" value="default publisher"><br>';
        $formular .= '<label for="publisher_year">Year:</label><br>';
        $formular .= '<input type="number" id="publisher_year" name="publisher_year" value="2000"><br><br>';
        $formular .= '<input type="submit" value="Submit"><br>';
        $formular .= "</form>";
        return $formular;
    }

    function display_books($books) :string {
        $current_books = "<div>";
        foreach($books as $book) {
            $current_books .= '<div class="books">';
            $current_books .= '<h4>Book '.$book["id"].'</h6>';
            $current_books .= '<p>Title: '.$book["title"].'</p>';
            $current_books .= '<p>Author: '.$book["author_name"].'</p>';
            $current_books .= '<p>Publisher: '.$book["publisher_name"].'</p>';
            $current_books .= '<p>Year: '.$book["publisher_year"].'</p>';
            $current_books .= '<form action="files/delete.php" method="POST"><input type="hidden" name="id" value="'.
                $book["id"].'"><input type="Submit" value="Delete"></form>';
            $current_books .= '<form action="files/edit.php" method="GET"><input type="hidden" name="id" value="'.
                $book["id"].'"><input type="Submit" value="Edit"></form>';
            $current_books .= '</div>';
            
        }
        $current_books .= "<div>";
        return $current_books;
    }

    function display_formular() {
        $books = get_all_books();
        echo display_books($books);
        echo create_formular();
    }
?>