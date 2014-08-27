<?php   
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
    
    use Comercial\dal;
    include("../../mundo/header.inc.php");
    include '../../dal/querybuilder.php';

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
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }

    //variaveis do BANCO
    $tabela = 'categoria';
    $rows = 'nome';
    $where = "idcategoria = $codigo";
    
    $valores = "ATIVO='N'";
    
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->desativar($codigo);
    echo "O resultado é: $resultado";
?>