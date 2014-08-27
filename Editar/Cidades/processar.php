<?php   
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
    
   $objeto = "Cidade";
    
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
    else {
        echo "</br>Variaveis nao enviadas!";
        return false;
    }
    
    $nomecidade = $_POST['nomecidade'];
    $idestado = $_POST['idestado'];
//    $idestado = $_POST['idestado'];
//    
//    $nomeestados = array(
//			"" => "--Escolha o Estado--",
//			11	=>	'Rond&ocirc;nia',
//                        12	=>	'Acre',
//                        13	=>	'Amazonas',
//                        14	=>	'Roraima',
//                        15	=>	'Par&aacute;',
//                        16	=>	'Amap&aacute;',
//                        17	=>	'Tocantins',
//                        21	=>	'Maranh&atilde;o',
//                        22	=>	'Piau&iacute;',
//                        23	=>	'Cear&aacute;',
//                        24	=>	'Rio Grande do Norte',
//                        25	=>	'Para&iacute;ba',
//                        26	=>	'Pernambuco',
//                        27	=>	'Alagoas',
//                        28	=>	'Sergipe',
//                        29	=>	'Bahia',
//                        31	=>	'Minas Gerais',
//                        32	=>	'Esp&iacute;rito Santo',
//                        33	=>	'Rio de Janeiro',
//                        35	=>	'S&atilde;o Paulo',
//                        41	=>	'Paran&aacute;',
//                        42	=>	'Santa Catarina',
//                        43	=>	'Rio Grande do Sul',
//                        50	=>	'Mato Grosso do Sul',
//                        51	=>	'Mato Grosso',
//                        52	=>	'Goi&aacute;s',
//                        53	=>	'Distrito Federal'
//			);
//    nomeestado='{$nomeestados[$idestado]}';
    //variaveis do BANCO
    $tabela = 'cidade';
    $where = "idcidade = $codigo and idestado='$idestado'";

    $valores = "
                nomecidade='$nomecidade'
    ";
    $qb = new dal\querybuilder($tabela, NULL, $where, $valores);
    $resultado = $qb->atualizar($codigo);
    echo "O resultado é: $resultado";
?>