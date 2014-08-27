<?php   
    
   
    $objeto = "Funcionario";
    
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
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        
        $tabela="funcionario";
                
        $valores = "
        login='$login',
        senha='$senha',
        nome='$nome',
        cpf='$cpf',
        rg='$rg',
        cep='$cep',
        endereco='$endereco',
        bairro='$bairro',
        idcidade='$idcidade',
        idestado='$idestado'";
        
        $where="idfuncionario = $codigo";
        
        $qb = new dal\querybuilder($tabela, null, $where, $valores);
        $qb->atualizar($codigo);
        
?>