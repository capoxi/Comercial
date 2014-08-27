<?php
       /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Cidade";
    
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
    
    $tabela = 'cidade';
    $rows = 'idestado,nomeestado,idcidade,nomecidade,ativo';

    $qb = new dal\querybuilder($tabela, $rows);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
   
    $form = new Form("editCidades");
    $form->configure(array(
        "action" => "processar.php"
    ));
    $form->addElement(new Element\HTML('<legend>Editar > Cidades</legend>'));
    $form->addElement(new Element\Hidden("form", "editCidades"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array(
        "required" => 1, "readonly" => "true", "value" => "{$resultado['ativo']}"
    )));
    $form->addElement(new Element\Hidden("codigo", $resultado['idcidade']));
    $form->addElement(new Element\Textbox("Nome:", "nomecidade", array(
        "required" => 1, "value" => "{$resultado['nomecidade']}"
    )));
    $form->addElement(new Element\Estado("Estado:","idestado", array(
        "required" => 1, "value" => "{$resultado['idestado']}", "readonly" => "true")));
    
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
