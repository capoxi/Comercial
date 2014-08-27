<?php   
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
    $objeto = "Categoria";
    
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
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }

    //variaveis do BANCO
    $tabela = 'categoria';
    $rows = 'nome';
    $where = "idcategoria = $codigo";

    $valores = "nome='$nome'";
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>