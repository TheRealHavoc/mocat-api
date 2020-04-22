<?php

    if(isset($_POST)) {
        $params = (object) array();

        if(!isset($_POST['username']))
            Response::error("Missing data", 400);

        if(!isset($_POST['password']))
            Response::error("Missing data", 400);

        $params->username = htmlspecialchars($_POST['username']);
        $params->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        $sql = $db->conn->prepare("INSERT INTO `users` (`id`, `username`, `password`, `token`) VALUES (NULL, :username, :password, NULL)");
        $sql->bindParam(':username', $params->username);
        $sql->bindParam(':password', $params->password);

        if(!$sql->execute())
            Response::error("Something went wrong", 500);

        Response::success("User created", 201);
    }