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
    
    $valores = "ATIVO='N'";
    
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->desativar($codigo);
    echo "O resultado é: $resultado";
?>