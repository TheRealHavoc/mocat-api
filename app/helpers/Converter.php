<?php
    class Converter
    {
        public static function OMDBRatingsToJSON($data)
        {
            $ratings = [];
            foreach($data as $source => $rating) {
                $ratings[$rating->Source] = $rating->Value;
            }

            return json_encode($ratings);
        }
    }