<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendedores";
    $qry = $con->query($sql);
    $vendedores = $qry->fetchAll(PDO::FETCH_OBJ);
    
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
    <title>Vendedores</title>
</head>
<body>
    
<h1>Lista de Vendedores</h1>
<hr>
<a href="frmvendedor.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Vendedor</th>
           <th>Data de Admissão</th>
           <th>Salário (R$)</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendedores as $vendedor) { ?>
        <tr>
            <td><?php echo $vendedor->idvendedor ?></td>
            <td><?php echo $vendedor->vendedor ?></td>
            <td><?php echo $vendedor->dtadmissao ?></td>
            <td><?php echo $vendedor->salario ?></td>
            <td><a href="frmvendedor.php?idvendedor=<?php echo $vendedor->idvendedor ?>">Editar</a></td>
            <td><a href="frmvendedor.php?op=del&idvendedor=<?php echo  $vendedor->idvendedor ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<a href="index.php">Menu Principal</a>
</body>
</html>