<?php

    class OMDB
    {
        /**
         * @param $value
         * @param int $page
         * @return false|string
         */
        public static function searchByTitle($value, $page = 1)
        {
            $host = 'http://www.omdbapi.com/';
            $apikey = 'd4eb0413';
            $value = rawurlencode($value);

            $url = "{$host}?apikey={$apikey}&s={$value}&page={$page}";

            return file_get_contents($url);
        }

        public static function searchByID($value)
        {
            $host = 'http://www.omdbapi.com/';
            $apikey = 'd4eb0413';
            $value = rawurlencode($value);

            $url = "{$host}?apikey={$apikey}&i={$value}";

            return file_get_contents($url);
        }
    }