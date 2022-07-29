<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

    // class db{

    //     //Properties
    //     private $host = 'localhost';
    //     private $user = 'root';
    //     private $password = '';
    //     private $dbname = 'mydatabase';

    //     //Connect
    //     public function connect(){
    //         $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";
    //         $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
    //         $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         return $dbConnection;
    //     }
    // }

    class db{


        // Connect to DB
            private $cleardb_server = "us-cdbr-east-06.cleardb.net";
            private $cleardb_username = "b8aa47054517dc";
            private $cleardb_password = "08b55673";
            private $cleardb_db = "heroku_93c44c9001c185a";
            // mysql://:@/?reconnect=true
            //connect
            public function connect(){
        
                $mysql_connect_str = "mysql:host=$this->cleardb_server;dbname=$this->cleardb_db";
                $dbConnection = new PDO($mysql_connect_str, $this->cleardb_username, $this->cleardb_password);
                // $pdo = new PDO("mysql:host=$this->cleardb_server; dbname=$this->cleardb_db, $cleardb_username, $cleardb_password);
                $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                return $dbConnection;
            }
        
        
        
        }
?>