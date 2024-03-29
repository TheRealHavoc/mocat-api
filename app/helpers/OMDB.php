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
            $host = OMDB_HOST;
            $apikey = OMDB_APIKEY;
            $value = rawurlencode($value);

            $url = "{$host}?apikey={$apikey}&s={$value}&page={$page}";

            if (!$json = file_get_contents(($url))) {
                Response::error("Could not connect to the OMDB API", 500);
            }

            return file_get_contents($url);
        }

        /**
         * @param $value
         * @return false|string
         */
        public static function searchByID($value)
        {
            $host = OMDB_HOST;
            $apikey = OMDB_APIKEY;
            $value = rawurlencode($value);

            $url = "{$host}?apikey={$apikey}&i={$value}";

            if (!$json = file_get_contents(($url))) {
                Response::error("Could not connect to the OMDB API", 500);
            }

            return file_get_contents($url);
        }
    }