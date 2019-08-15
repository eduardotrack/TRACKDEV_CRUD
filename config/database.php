<?php
    class Database{
        // Especifica suas próprias credenciais de banco de dados
        private $host = "localhost";
        private $db_name = "php_poo_crud";
        private $username = "root";
        private $password = "";
        
        public $conn;
        
        // Obtém a conexão com o banco de dados
        public function getConnection(){
            
            $this -> conn = null;
            
            try{
                $this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db_name, $this -> username, $this -> password);
            }catch(PDOException $exception){
                echo "Erro de conexão: ". $exception -> getMessage();
            }
            
            return $this -> conn;
        }
    }

?>