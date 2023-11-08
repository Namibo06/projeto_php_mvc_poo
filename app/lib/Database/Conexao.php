<?php 
    abstract class Conexao{
        private static $pdo;
        public static function getConn(){
            try {
                if (self::$pdo === null) {
                    self::$pdo= new PDO('pgsql:host=localhost;dbname=crud','postgres','Hiper12*');
                }
                return self::$pdo;
            } catch (PDOException $e) {
                echo "Seu erro é: ".$e->getMessage();
            }
            
        }
    }
?>