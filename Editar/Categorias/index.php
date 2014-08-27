<?php
     
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Categoria";
    
    include_once '../editar.inc.php';
    
    use Comercial\dal;
    use PFBC\Form;
    use PFBC\Element;

    
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
    
    $tabela = 'categoria';
    $rows = 'nome';
    $where = "idcategoria = '$codigo'";
    
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
  
    $form = new Form("editarmarcas");
    $form->configure( array(
        "action" => "processar.php"
    ));
    
    $form->setHeader($mode = "ra");
    
    $form->addElement(new Element\Hidden("codigo", $codigo));
    $form->addElement(new Element\Textbox("Nome:", "nome", array(
        "required" => 1, "value" => "{$resultado['nome']}"
    )));
        
    $form->setFooter();
    
    $form->render();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
