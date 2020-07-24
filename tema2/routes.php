<?php
    return [
        "/book" => [
            "controllers/BookController.php",
            "models/BookModel.php",
            "views/BookView.php",
        ],
        "/" => [
            "controllers/Controller.php",
            "controllers/MainController.php",
            "models/Model.php",
            "views/View.php"
        ],
        "/author" => [
            "controllers/AuthorController.php",
            "models/AuthorModel.php",
            "views/AuthorView.php",
        ],
        "/publisher" => [
            "controllers/PublisherController.php",
            "models/PublisherModel.php",
            "views/PublisherView.php",
        ]

    ];