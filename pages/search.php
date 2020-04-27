<?php

    if(isset($_GET['title'])) {
        $params = (object) array();

        $params->title = $_GET['title'];

        $results = OMDB::searchByTitle($params->title);

        Response::json(
            $results
        );
    }

    if(isset($_GET['id'])) {
        $params = (object) array();

        $params->id = $_GET['id'];

        $results = OMDB::searchByID($params->id);

        Response::json(
            $results
        );
    }

    Response::error("No search parameters entered", 400);