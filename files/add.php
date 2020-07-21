<?php

    function create_formular() :string {
        $formular = "<div class=\"add_form\"><form action=\"store.php\" method=\"POST\">";
        $formular .= '<label for="title">Title:</label><br>';
        $formular .= '<input type="text" id="title" name="title" value="default title"><br>';
        $formular .= '<label for="author_name">Author:</label><br>';
        $formular .= '<input type="text" id="author_name" name="author_name" value="default author"><br>';
        $formular .= '<label for="publisher_name">Publisher:</label><br>';
        $formular .= '<input type="text" id="publisher_name" name="publisher_name" value="default publisher"><br>';
        $formular .= '<label for="publisher_year">Year:</label><br>';
        $formular .= '<input type="number" id="publisher_year" name="publisher_year" value="2000"><br><br>';
        $formular .= '<input type="submit" value="Submit"><br>';
        $formular .= "</form></div>";
        return $formular;
    }

    echo create_formular();
