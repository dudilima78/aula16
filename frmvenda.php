<?php 

$idvenda = isset($_GET["idvenda"]) ? $_GET["idvenda"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendas where idvenda= :idvenda";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvenda",$idvenda);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if($idvenda){
            $sql = "SELECT * FROM  vendas where idvenda= :idvenda";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvenda",$idvenda);
            $stmt->execute();
            $venda = $stmt->fetch(PDO::FETCH_OBJ);
            
        }
        if($_POST){
            if($_POST["idvenda"]){
                $sql = "UPDATE vendas SET idproduto=:idproduto, idvendedor=:idvendedor, qtd=:qtd WHERE idvenda =:idvenda";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":qtd", $_POST["qtd"]);
                $stmt->bindValue(":idvenda", $_POST["idvenda"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendas(idproduto,idvendedor,qtd) VALUES (:idproduto,:idvendedor,:qtd)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idproduto",$_POST["idproduto"]);
                $stmt->bindValue(":idvendedor",$_POST["idvendedor"]);
                $stmt->bindValue(":qtd",$_POST["qtd"]);
                $stmt->execute(); 
            }
            header("Location:listarvendas.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendas</title>
</head>
<body>
<h1>Cadastro de Vendas</h1>
<hr>
<form method="POST">
Nº do Produto:  <input type="text" name="idproduto"        value="<?php echo isset($venda) ? $venda->idproduto : null ?>"><br><br>
Registro do Vendedor: <input type="text" name="idvendedor"       value="<?php echo isset($venda) ? $venda->idvendedor : null ?>"><br><br>
Quantidade: <input type="text" name="qtd"       value="<?php echo isset($venda) ? $venda->qtd : null ?>"><br><br>
<input type="hidden"     name="idvenda"   value="<?php echo isset($venda) ? $venda->idvenda : null ?>">
<input type="submit" value="Cadastrar">
</form>
<hr>
<a href="listarvendas.php">Voltar</a> |
<a href="index.php">Menu Principal</a>
</body>
</html>