<?php
   
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Produto";
    include_once '../editar.inc.php';
    
    use Comercial\dal;
    
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
    $nome = $_POST['nome'];
    $idcategoria = $_POST['idcategoria'];
    $idmarca = $_POST['idmarca'];
    $idfornecedor = $_POST['idfornecedor'];
    $qtdestoque = $_POST['qtdestoque'];
    $unidade = $_POST['unidade'];
    $valorcompra = $_POST['valorcompra'];
    $valorvenda = $_POST['valorvenda'];

    $valores = "
    nome='$nome',
    idcategoria='$idcategoria',
    idmarca='$idmarca',
    idfornecedor='$idfornecedor',
    qtdestoque='$qtdestoque',
    unidade='$unidade',
    valorcompra='$valorcompra',
    valorvenda='$valorvenda'";

    $where = "idproduto='$codigo'";

    $qb = new dal\querybuilder($tabela, NULL, $where, $valores);
    $qb->atualizar($codigo);
   
?>