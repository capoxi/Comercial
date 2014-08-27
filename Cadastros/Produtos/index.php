<?php
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Produtos";
    $titulo = "";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
    if (isset($_POST['nome'])) {
        $tabela = 'produto';
        $rows = 'nome,idcategoria,idmarca,idfornecedor,qtdestoque,
                unidade,valorcompra,valorvenda';
        $nome = $_POST['nome'];
        $idcategoria = $_POST['idcategoria'];
        $idmarca = $_POST['idmarca'];
        $idfornecedor = $_POST['idfornecedor'];
        $qtdestoque = $_POST['qtdestoque'];
        $unidade = $_POST['unidade'];
        $valorcompra = $_POST['valorcompra'];
        $valorvenda = $_POST['valorvenda'];
        
        $ativo = $_POST['ativo'];
        
        $valores = "
        '$nome',
        '$idcategoria',
        '$idmarca',
        '$idfornecedor',
        '$qtdestoque',
        '$unidade',
        '$valorcompra',
        '$valorvenda'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
    }
    
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
    
    //array ativo
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
    
    $form = new Form("cadprodutos");
    $form->addElement(new Element\HTML('<legend>Cadastros > Produtos</legend>'));
    $form->addElement(new Element\Hidden("form", "cadprodutos"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array (
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1
    )));
    $form->addElement(new Element\Select("Categoria: ", "idcategoria", $categoria, array(
        "required" => 1
    )));
    $form->addElement(new Element\Select("Fabricante: ", "idmarca", $marca, array(
        "required" => 1
    )));
    $form->addElement(new Element\Select("Fornecedor: ", "idfornecedor", $fornecedor, array(
        "required" => 1
    )));
    $form->addElement(new Element\Number("Quant. Estoque","qtdestoque"));
    $form->addElement(new Element\UnidadeLong("Unidade","unidade"));
    $form->addElement(new Element\Number("Valor de Compra: ","valorcompra"));
    $form->addElement(new Element\Number("Valor de Venda: ","valorvenda"));
    
    $form->addElement(new Element\Button("Cadastrar"));
    $form->addElement(new Element\Button("Cancelar", "button", array(
        "onclick" => "history.go(-1);"
    )));
    $form->render();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
