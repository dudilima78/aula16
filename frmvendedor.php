<?php 

$idvendedor = isset($_GET["idvendedor"]) ? $_GET["idvendedor"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendedores where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            header("Location:listarvendedores.php");
        }


        if($idvendedor){
            
            $sql = "SELECT * FROM  vendedores where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            $vendedor = $stmt->fetch(PDO::FETCH_OBJ);
            
        }
        if($_POST){
            if($_POST["idvendedor"]){
                $sql = "UPDATE vendedores SET vendedor=:vendedor, dtadmissao=:dtadmissao, salario=:salario WHERE idvendedor =:idvendedor";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor", $_POST["vendedor"]);
                $stmt->bindValue(":dtadmissao", $_POST["dtadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendedores(vendedor,dtadmissao,salario) VALUES (:vendedor,:dtadmissao,:salario)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor",$_POST["vendedor"]);
                $stmt->bindValue(":dtadmissao",$_POST["dtadmissao"]);
                $stmt->bindValue(":salario",$_POST["salario"]);
                $stmt->execute(); 
            }
            header("Location:listarvendedores.php");
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
    <title>Vendedores</title>
</head>
<body>
<h1>Cadastro de Vendedores</h1>
<hr>
<form method="POST">
Vendedor:  <input type="text" name="vendedor"        value="<?php echo isset($vendedor) ? $vendedor->vendedor : null ?>"><br><br>
Data de Admissão: <input type="date" name="dtadmissao"       value="<?php echo isset($vendedor) ? $vendedor->dtadmissao : null ?>"><br><br>
Salário:  <input type="text" name="salario"        value="<?php echo isset($vendedor) ? $vendedor->salario : null ?>"><br><br>
<input type="hidden"     name="idvendedor"   value="<?php echo isset($vendedor) ? $vendedor->idvendedor : null ?>">
<input type="submit" value="Cadastrar">
</form>
<hr>
<a href="listarvendedores.php">Voltar</a> |
<a href="index.php">Menu Principal</a>
</body>
</html>