<?php
    class Response
    {
        /**
         * @param $data
         * @param int $http_response_code
         */
        public static function data($data, $http_response_code = 200)
        {
            self::headers($http_response_code);

            $data = ["data" => $data];

            echo json_encode($data);

            die;
        }

        /**
         * @param $data
         * @param int $http_response_code
         */
        public static function success($message, $http_response_code)
        {
            self::headers($http_response_code);

            $message = ["message" => ["code" => $http_response_code, "messages" => $message]];

            echo json_encode($message);

            die;
        }

        /**
         * @param $error
         * @param $http_response_code
         */
        public static function error($error, $http_response_code)
        {
            self::headers($http_response_code);

            $error = ["error" => ["code" => $http_response_code, "messages" => $error]];

            echo json_encode($error);

            die;
        }

        /**
         * @param $http_response_code
         */
        private static function headers($http_response_code)
        {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");

            http_response_code($http_response_code);
        }
    }