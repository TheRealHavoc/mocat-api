<?php
    class Database
    {
        public $conn;

        /**
         * Database constructor.
         */
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

        /**
         * @param $username
         * @return mixed
         */
        public function getUserByUsername($username)
        {
            $query = "SELECT `id`, `username`, `password` FROM `users` WHERE `username` = :username";

            $sql = $this->conn->prepare($query);
            $sql->bindParam(':username', $username);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            return $sql->fetch();
        }

        /**
         * @param $token
         * @param $id
         */
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

        /**
         * @param $data
         */
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

            try {
                $sql->execute($binds);
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    Response::error("Media already exists in the database", 500);
                } else {
                    Response::error("Something went wrong", 500);
                }
            }

        }
    }