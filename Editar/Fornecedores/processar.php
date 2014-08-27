<?php   
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
    
    $objeto = "Fornecedor";
    
    include_once '../editar.inc.php';
    
    use Comercial\dal;
    
    if(isset($_POST['codigo'])){
        echo "</br>Codigo OK";
        //variaveis POST
        $codigo = $_POST['codigo'];
    }
    if (isset($_POST['razaosocial'])) {
        echo "</br>Nome OK";
    }
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }   

    $razaosocial = $_POST['razaosocial'];
    $fantasia = $_POST['fantasia'];
    $cnpj = $_POST['cnpj'];
    $ie = $_POST['ie'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $idcidade = $_POST['idcidade'];
    $idestado = $_POST['idestado'];
    $idtransportadora = $_POST['idtransportadora'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    
    //variaveis do BANCO
    $tabela = 'fornecedor';
    $where = "idfornecedor = '$codigo'";
    
    $valores = "
        razaosocial='$razaosocial',
        fantasia='$fantasia',
        cnpj='$cnpj',
        ie='$ie',
        cep='$cep',
        endereco='$endereco',
        bairro='$bairro',
        idcidade='$idcidade',
        idestado='$idestado',
        idtransportadora='$idtransportadora',
        fone='$fone',
        email='$email'  
    ";
    
    $qb = new dal\querybuilder($tabela, NULL, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>