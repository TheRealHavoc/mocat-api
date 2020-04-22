<?php

    if(isset($_POST)) {
        $params = (object) array();

        if(!isset($_POST['username']))
            Response::error("Missing data", 400);

        if(!isset($_POST['password']))
            Response::error("Missing data", 400);

        $params->username = htmlspecialchars($_POST['username']);
        $params->password = htmlspecialchars($_POST['password']);

        if(!$res = $db->getUserByUsername($params->username))
            Response::error("You have entered the wrong credentials", 400);

        if(!password_verify($params->password, $res['password']))
            Response::error("You have entered the wrong credentials", 400);

        $token = Token::createGeneric();

        $db->updateToken($token, $res['id']);

        Response::data([
            'username' => $params->username,
            'token' => $token
        ]);
    }