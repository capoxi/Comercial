<?php   
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
    
    include("../../mundo/header.inc.php");    
    include ("../../dal/querybuilder.php");
    include ("../../mundo/checkCadastros.inc.php");
    
    $chk = new checkCadastros("Editar");
    $resultado = $chk->chkGetCodigo();
    if (!$resultado) {
        return false;
    }
    unset($resultado);
    unset($chk);
    
    if (isset($_GET['codigo']))
        $codigo = $_GET['codigo'];
    elseif (isset($_POST['codigo']))
        $codigo = $_POST['codigo'];
    
    //variaveis do BANCO
    $tabela = 'produto';
    $valores = "ATIVO='N'";

    $where = "idproduto='$codigo'";

    $qb = new dal\querybuilder($tabela, NULL, $where, $valores);
    $qb->desativar($codigo);
   
?>