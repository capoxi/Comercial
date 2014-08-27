<?php
    
   
    $objeto = "Marca";
    include_once '../editar.inc.php';
    
    use Comercial\dal;
    
    
    if(isset($_POST['codigo'])){
        echo "</br>Codigo OK";
        $codigo = $_POST['codigo'];
        //variaveis POST
    //    $codigo = $_POST['codigo'];
    //    $nome = $_POST['nome'];
    //    $email = $_POST['email'];
    }
    if (isset($_POST['nome'])) {
        echo "</br>Nome OK";
        $nome = $_POST['nome'];
    }
    if (isset($_POST['email'])) {
        echo "</br>Email OK";
        $email = $_POST['email'];
    }
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }

    //variaveis do BANCO
    $tabela = 'marca';
    $rows = 'nome, email';
    $where = "idmarca = $codigo";

    $valores = "nome='$nome',email='$email'";
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>