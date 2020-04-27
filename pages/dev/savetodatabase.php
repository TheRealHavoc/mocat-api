<?php
    Auth::authenticateByToken($db);

    if(isset($_GET['id'])) {
        $params = (object) array();

        $params->id = $_GET['id'];

        $results = OMDB::searchByID($params->id);

        $db->saveMedia($results);

        Response::success("Media saved to database", 200);
    }

    Response::error("No save parameters entered", 400);
