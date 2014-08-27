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
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        $fone = $_POST['fone'];
        $datanascimento = $_POST['datanascimento'];
        $sexo = $_POST['sexo'];
        $estadocivil = $_POST['estadocivil'];
        
        
    //variaveis do BANCO
    $tabela = 'cliente';
    $rows = '*';
    $where = "idcliente = '$codigo'";
    $valores = "ATIVO='N'"
    ;
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->atualizar();
    echo "O resultado é: $resultado.</br>Registro inativado.";
?>