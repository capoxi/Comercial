<?php 
    $objeto = "Cliente";
    
    include_once '../editar.inc.php';
    
    use Comercial\dal;

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
    $rows = 'nome,email,cpf,rg,cep,endereco,bairro,
                idcidade,idestado,fone,datanascimento,
                sexo,estadocivil';
    $where = "idcliente = '$codigo'";
    $valores = "
        nome='$nome',
        email='$email',
        cpf='$cpf',
        rg='$rg',
        cep='$cep',
        endereco='$endereco',
        bairro='$bairro',
        idcidade='$idcidade',
        idestado='$idestado',
        fone='$fone',
        datanascimento='$datanascimento',
        sexo='$sexo',
        estadocivil='$estadocivil'";
    $qb = new dal\querybuilder($tabela, $rows, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>