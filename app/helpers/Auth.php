<?php

    class Auth
    {
        public static function authenticateByToken($db)
        {
            $request = (object) array();

            $request->headers = getallheaders();

            $sql = $db->conn->prepare('SELECT `token` FROM `users` WHERE `username` = :username');
            $sql->bindParam(':username', $request->headers['username']);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            if(!$res = $sql->fetch())
                Response::error("Something went wrong with the authentication", 400);

            if($request->headers['token'] !== $res['token'])
                Response::error("Something went wrong with the authentication", 400);

            return true;
        }
    }