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
        
        $tabela="funcionario";
                
        $valores = "ATIVO = 'N'";
        
        $where="idfuncionario = $codigo";
        
        $qb = new dal\querybuilder($tabela, null, $where, $valores);
        $qb->atualizar();
        
?>