<?php
    class Token
    {
        /**
         * @return string
         */
        public static function createGeneric()
        {
            return md5(uniqid(rand(), true));
        }
    }