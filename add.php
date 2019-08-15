<?php
    // Configs Temporarias
    
    // Inclui arquivos de banco de dados e objeto
    include_once 'config/database.php';
    include_once 'objetos/produto.php';
    include_once 'objetos/categoria.php';

    // Obter conexão com o banco de dados
    $database = new Database();
    $db = $database -> getConnection();

    // Passa a conexão aos objetos
    $produto = new Produto($db);
    $categoria = new Categoria($db);

    // Header da Pagina
    $page_title = "Cadastrar";
    
    require_once 'theme/layout_header.php';
     
    /*echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Ver Registros</a>";
    echo "</div>";*/
?>
    
    <!-- Formulário HTML para criar um registro -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <!-- Código PHP Post temporario -->
            <?php
                // Se o formulário foi submetido
                if($_POST){
 
                    // Setar valores de produtos
                    $produto->nome = $_POST['nome'];
                    $produto->preco = $_POST['preco'];
                    $produto->descricao = $_POST['descricao'];
                    $produto->categoria_id = $_POST['categoria_id'];

                    // Cadastrar Produto
                    if($produto->create()){
                        echo "<div class='alert alert-success'>Produto cadastrado.</div>";
                    } else {
                        // Se não for possível criar o produto, informe o usuário
                        echo "<div class='alert alert-danger'>Não é possível cadastrar o produto.</div>";
                    }
                }
            ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="trackcrud-form">
                <input type="text" name="nome"  />
                <input type="text" name="preco" />

                <textarea name="descricao"></textarea>

                <?php 
                    // Leia as categorias de produtos do banco de dados
                    $stmt = $categoria -> read();

                    // Colocá-los em uma lista suspensa de seleção
                    echo "<select name='categoria_id'>";
                        echo "<option>Selecionar categoria...</option>";

                        while ($row_categoria = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row_categoria);
                            echo "<option value='{$id}'>{$nome}</option>";
                        }

                    echo "</select>";
                ?>
                <br>
                
                <button type="submit" >Cadastrar</button>
            </form>
        </div>
    </div>

<?php
    require_once 'theme/layout_footer.php';