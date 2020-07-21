<?php
    class DB{
        private static $conn = NULL;
        
        public static function get_connection() {
            if (is_null(self::$conn)) {
                self::$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            }
            return self::$conn;
        }    
    }
