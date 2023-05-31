<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idComanda']))
{
    $id_comanda_get = $_GET['idComanda'];

}

if (isset($_POST['cadastrar']))
{
    $id_comanda = $_POST['id_comanda'];
    $nome = $_POST['nome'];
    $id_situacao = $_POST['id_situacao'];
    $id_origem = $_POST['id_origem'];

    $mysql_query = "INSERT INTO `comanda`(`idComanda`, `nomeClienteComanda`, `idOrigem`, `idSituacao`) 
    VALUES (
    '{$id_comanda}', 
    '{$nome}',
    '{$id_origem}',
    '{$id_situacao}'
    )";

    $insertItensComanda = $conn->query($mysql_query);

    header("Location: comanda.php");
    mysqli_close($conn);    	
}
else
{
    $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
    $selectOpCardapio = $conn->query($mysql_query);
    
    $mysql_query1 = "SELECT * FROM origem_comanda";
    $selectOrigem = $conn->query($mysql_query1);
    
    $mysql_query2 = "SELECT * FROM situacao_comanda";
    $selectSituacao = $conn->query($mysql_query2);

}

?>

<div class="container">
    <br>
    <h2>Nova Comanda</h2>
    <p>Cadastro de comanda</p>
    <hr>
    <br>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?php echo"$id_comanda_get" ?>">
            
            <div class="row">
                <div class="col-4">
                    <label for="nome">Nome do cliente</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="col-4">  
                    <label for="id_origem">Origem</label>
                    <select class="form-select" name="id_origem" required>
                        <option selected>Selecione...</option>
                        <?php while ($row_origem = mysqli_fetch_array($selectOrigem, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_origem['idOrigem'];?>"><?= $row_origem['descricaoOrigem'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-4">  
                    <label for="id_situacao">Situação</label>
                    <select class="form-select" name="id_situacao" required>
                        <option selected>Selecione...</option>
                        <?php while ($row_situacao = mysqli_fetch_array($selectSituacao, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_situacao['idSituacao'];?>"><?= $row_situacao['descricao'];?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <br>
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
        </form>
        <br>
        <br>
        


    </div>
</div>

<br>
<?php require("footer.php"); ?>