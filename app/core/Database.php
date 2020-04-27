<?php
    class Database
    {
        public $conn;

        public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DATABASE, SQL_USER, SQL_PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                Response::error(
                    ['error' => $e->getMessage()],
                    500
                );
            }

            return $this->conn;
        }

        public function getUserByUsername($username)
        {
            $query = "SELECT `id`, `username`, `password` FROM `users` WHERE `username` = :username";

            $sql = $this->conn->prepare($query);
            $sql->bindParam(':username', $username);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            return $sql->fetch();
        }

        public function updateToken($token, $id)
        {
            $query = "UPDATE `users` SET `token` = :token WHERE `users`.`id` = :id";

            $sql = $this->conn->prepare($query);
            $sql->bindParam(':token', $token);
            $sql->bindParam(':id', $id);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            return;
        }

        public function saveMedia($data)
        {
            $data = json_decode($data);
            unset($data->Response);

            $query = "
                INSERT INTO `media` 
                    (
                        `title`, 
                        `year`, 
                        `rated`, 
                        `released`, 
                        `runtime`, 
                        `genre`, 
                        `director`, 
                        `writer`, 
                        `actors`, 
                        `plot`, 
                        `language`, 
                        `country`, 
                        `awards`, 
                        `poster`, 
                        `ratings`, 
                        `metascore`, 
                        `imdbrating`, 
                        `imdbvotes`, 
                        `imdbid`, 
                        `type`, 
                        `dvd`, 
                        `boxoffice`, 
                        `production`, 
                        `website`
                    ) 
                VALUES 
                    (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?
                    );
            ";

            $sql = $this->conn->prepare($query);

            $data->Ratings = Converter::OMDBRatingsToJSON($data->Ratings);

            $binds = [];
            foreach($data as $key => $value) {
                $binds[] = $value;
            }

            if(!$sql->execute($binds))
                Response::error("Something went wrong", 500);

        }
    }