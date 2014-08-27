<?php   

    use Comercial\dal;
    include 'header.inc.php';

    if(isset($_POST['codigo'])){
        echo "</br>Codigo OK";
        $codigo = $_POST['codigo'];
    }
    if (isset($_POST['razaosocial'])) {
        echo "</br>Nome OK";
    }
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }   
    
        
    //variaveis do BANCO
    $tabela = 'transportadora';
    
    $where = "idtransportadora = '$codigo'";
    
    $valores = "ATIVO='N'";
    
    $qb = new dal\querybuilder($tabela, NULL, $where, $valores);
    $resultado = $qb->desativar($codigo);
    echo "O resultado é: $resultado";
?>