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
        //variaveis POST
    //    $codigo = $_POST['codigo'];
    //    $nome = $_POST['nome'];
    //    $email = $_POST['email'];
    }
    if (isset($_POST['nome'])) {
        echo "</br>Nome OK";
    }
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }   
    $codigo = $_POST['codigo'];
        
        
    //variaveis do BANCO
    $tabela = 'fornecedor';
    
    $where = "idfornecedor = '$codigo'";
    $valores = "ATIVO = 'S'";
    $qb = new dal\querybuilder($tabela, null, $where, $valores);
    $resultado = $qb->atualizar();
    echo "O resultado é: $resultado";
?>