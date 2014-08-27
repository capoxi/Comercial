<?php
    
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Cidade";
    $acao = "Excluir";
    $titulo = "";
    

    
    
    
    use Comercial\dal;
    use PFBC\Form;
    use PFBC\Element;

    include("../../formbuilder/PFBC/Form.php");
    include("../../mundo/header.inc.php");    
    include '../../dal/querybuilder.php';
    include("../../mundo/checkCadastros.inc.php");
    
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
    
    $tabela = 'cidade';
    $rows = 'idestado,nomeestado,idcidade,nomecidade,ativo';

    $qb = new dal\querybuilder($tabela, $rows);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
    $form = new Form("excluirCidades");
    $form->configure(array(
        "action" => "processar.php"
    ));
    $form->addElement(new Element\HTML('<legend>Excluir > Cidades</legend>'));
    $form->addElement(new Element\Hidden("form", "excluirCidades"));
    
    $form->addElement(new Element\Hidden("codigo", $resultado['idcidade']));
    $form->addElement(new Element\Textbox("Nome:", "nomecidade", array(
        "required" => 1, "value" => "{$resultado['nomecidade']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Estado("Estado:","idestado", array(
        "required" => 1, "value" => "{$resultado['idestado']}", "readonly" => "true")));
    
    $form->addElement(new Element\Button("Excluir/Inativar"));
    $form->addElement(new Element\Button("Cancelar", "button", array(
        "onclick" => "history.go(-1);"
    )));
    $form->render();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
