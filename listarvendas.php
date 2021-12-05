<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendas";
    $qry = $con->query($sql);
    $vendas = $qry->fetchAll(PDO::FETCH_OBJ);
    
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
</head>
<body>
    
<h1>Lista de Vendas</h1>
<hr>
<a href="frmvenda.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Nº do Produto</th>
           <th>Registro do Vendedor</th>
           <th>Quantidade</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendas as $venda) { ?>
        <tr>
            <td><?php echo $venda->idvenda ?></td>
            <td><?php echo $venda->idproduto ?></td>
            <td><?php echo $venda->idvendedor ?></td>
            <td><?php echo $venda->qtd ?></td>
            <td><a href="frmvenda.php?idvenda=<?php echo $venda->idvenda ?>">Editar</a></td>
            <td><a href="frmvenda.php?op=del&idvenda=<?php echo  $venda->idvenda ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<a href="index.php">Menu Principal</a>
</body>
</html>