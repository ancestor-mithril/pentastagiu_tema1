<html>
<head>
    <title>Title</title>
    <style type="text/css">
    .books {
        border: 5px outset red;
        text-align: center;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
    </style>
</head>
<body>
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
        $current_books .= '</div><form action="files/add.php" method="POST"><input type=Submit 
            value="Add new book"></form>';
        return $current_books;
    }

    function display_formular() {
        $books = get_all_books();
        echo display_books($books);
        
    }

    display_formular();
?>
</body>
</html>