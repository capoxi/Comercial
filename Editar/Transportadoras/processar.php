<?php 
   
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Transportadoras";
    include_once '../editar.inc.php';
    
    use Comercial\dal;
    

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
        $rows = 'razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
                idcidade,idestado,fone,email';
        $razaosocial = $_POST['razaosocial'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];
        $ie = $_POST['ie'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        
        
    //variaveis do BANCO
    $tabela = 'transportadora';
    $rows = 'razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
            idcidade,idestado,idtransportadora,fone,email';
    $where = "idtransportadora = '$codigo'";
    
    $valores = "
        idtransportadora='$codigo',
        razaosocial='$razaosocial',
        fantasia='$fantasia',
        cnpj='$cnpj',
        ie='$ie',
        cep='$cep',
        endereco='$endereco',
        bairro='$bairro',
        idcidade='$idcidade',
        idestado='$idestado',
        fone='$fone',
        email='$email'  
    ";
    
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>