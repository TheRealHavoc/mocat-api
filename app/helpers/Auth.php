<?php

    class Auth
    {
        public static function authenticateByToken($db, $username, $token)
        {
            $sql = $db->conn->prepare('SELECT `token` FROM `users` WHERE `username` = :username');
            $sql->bindParam(':username', $username);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            if(!$res = $sql->fetch())
                Response::error("Something went wrong with the authentication", 400);

            if($token !== $res['token'])
                Response::error("Something went wrong with the authentication", 400);

            return true;
        }
    }