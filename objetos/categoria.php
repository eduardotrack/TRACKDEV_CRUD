<?php
    class Categoria{
        // Conexão do banco de dados e nome da tabela
        private $conn;
        private $table_name = "categorias";
        
        // Propriedades do objeto
        public $id;
        public $name;
        
        public function __construct($db){
            $this -> conn = $db;
        }
        
        // Usado pela lista suspensa de seleção
        function read(){
            // Seleciona todos os dados
            $query = "SELECT id, nome FROM ".$this->table_name." ORDER BY nome";
            
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            
            return $stmt;
        }
        
        // Usado para ler o nome da categoria por seu ID
        function readName(){
            $query = "SELECT nome FROM ".$this->table_name." WHERE id= ? limit 0, 1";
            
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $this->id);
            $stmt -> execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this -> name = $row['nome'];
        }
    }
?>