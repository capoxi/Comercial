<?php

     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Produto";
    $acao = "Excluir";
    $titulo = "";
    
    
    
    use PFBC\Form;
    use PFBC\Element;

    include("../../formbuilder/PFBC/Form.php");
    include("../../mundo/header.inc.php");    
    include ("../../dal/querybuilder.php");
    include ("../../mundo/checkCadastros.inc.php");
    
    
    $chk = new checkCadastros("Excluir");
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
    
    //traz categoria
    $tabela = "categoria";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $categoria = array();
    while ($col = mysql_fetch_array($consulta)) {
         $categoria += array("$col[0]" => "$col[1]");
    }
    if (!$categoria)
            $categoria += array("" => "N&atilde;o h&aacute; itens cadastrados.");
    unset($qb);
    
    //traz marca
    $tabela = "marca";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $marca = array();
    while ($col = mysql_fetch_array($consulta)) {
        $marca += array("$col[0]" => "$col[1]");
    }
    if (!$marca)
            $marca += array("" => "N&atilde;o h&aacute; itens cadastrados.");
    unset($qb);
    
    //traz fornecedor
    $tabela = "fornecedor";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $fornecedor = array();
    while ($col = mysql_fetch_array($consulta)) {
        $fornecedor += array("$col[0]" => "$col[1] ($col[2])");
    }
    if (!$fornecedor)
            $fornecedor += array("" => "N&atilde;o h&aacute; itens cadastrados.");
    unset($qb);
    
    //traz produto
    $tabela = "produto";
    $rows = "idproduto, nome, idcategoria, idmarca,
        idfornecedor, qtdestoque, unidade, valorcompra, valorvenda, ativo";
    $where = "idproduto = '$codigo'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
    
    //array ativo
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
    
    
    $form = new Form("excluirProdutos");
    $form->configure(array(
       "action" => "processar.php" 
    ));
    $form->addElement(new Element\HTML('<legend>Excluir > Produtos</legend>'));
    $form->addElement(new Element\Hidden("form", "excluirProdutos"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array (
        "required" => 1, "readonly" => "true"
    )));
    
    $form->addElement(new Element\Hidden("codigo",$codigo));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1, "value" => "{$resultado['nome']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Categoria: ", "idcategoria", $categoria, array(
        "required" => 1, "value" => "{$resultado['idcategoria']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Fabricante: ", "idmarca", $marca, array(
        "required" => 1, "value" => "{$resultado['idmarca']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Fornecedor: ", "idfornecedor", $fornecedor, array(
        "required" => 1, "value" => "{$resultado['idfornecedor']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("Quant. Estoque","qtdestoque",array(
        "value" => "{$resultado['qtdestoque']}", "readonly" => "true"
    )));
    $form->addElement(new Element\UnidadeLong("Unidade","unidade", array(
        "value" => "{$resultado['unidade']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("Valor de Compra: ","valorcompra", array(
        "value" => "{$resultado['valorcompra']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("Valor de Venda: ","valorvenda", array(
        "value" => "{$resultado['valorvenda']}", "readonly" => "true"
    )));
    
    $form->addElement(new Element\Button("Editar"));
    $form->addElement(new Element\Button("Cancelar", "button", array(
        "onclick" => "history.go(-1);"
    )));
    $form->render();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
