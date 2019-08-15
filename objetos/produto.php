<?php
    class Produto{
        // Conexão do banco de dados e nome da tabela
        private $conn;
        private $table_name = "produtos";
        
        // Propriedades do objeto
        public $id;
        public $nome;
        public $preco;
        public $descricao;
        public $categoria_id;
        public $timestamp;
        
        public function __construct($db){
            $this->conn = $db;
        }
        
        // Criar produto
        function create(){
            // Escrever consulta
            $query = "INSERT INTO ".$this->table_name." SET nome=:nome, preco=:preco, descricao=:descricao, categoria_id=:categoria_id, criado=:criado";
            
            $stmt = $this->conn->prepare($query);;
            
            // Valores do POST
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->preco=htmlspecialchars(strip_tags($this->preco));
            $this->drescricao=htmlspecialchars(strip_tags($this->descricao));
            $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
            
            // Obter a data/hora para o campo 'Criado'
            $this->timestamp = date('Y-m-d H:i:s');
            
            // Vincular Valores
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":categoria_id", $this->categoria_id);
            $stmt->bindParam(":criado", $this->timestamp);
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>