<?php
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Transportadoras";
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
    
    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
    }
    elseif (isset($_POST['codigo'])){
        $codigo = $_POST['codigo'];
    }
    
     //traz cidade
    $tabela = "cidade";
    $rows = "idcidade, nomecidade, nomeestado";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $consulta = $qb->consultar();
    $cidade = array();
    
    while ($col = mysql_fetch_array($consulta)) 
        $cidade += array("$col[0]" => "$col[1] ($col[2])");
    if (!$cidade)
        $cidade += array("" => "N&atilde;o existem itens cadastrados.");
    unset($qb);
    
    $tabela = 'transportadora';
    $rows = 'razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
            idcidade,idestado,idtransportadora,fone,email';
    $where = "idtransportadora = '$codigo'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
    $form = new Form("editTransportadoras");
    
    $form->configure(array(
        "action" => "processar.php"
    ));
    $form->addElement(new Element\HTML('<legend>Editar > Transportadoras</legend>'));
    $form->addElement(new Element\Hidden("form", "editTransportadoras"));
    
    $form->addElement(new Element\Hidden("codigo","{$resultado['idtransportadora']}"));
    
    $form->addElement(new Element\Textbox("Raz&atilde;o Social: ", "razaosocial", array(
        "required" => 1, "value" => "{$resultado['razaosocial']}"
    )));
    $form->addElement(new Element\Textbox("Nome Fantasia: ", "fantasia", array(
        "required" => 1, "value" => "{$resultado['fantasia']}"
    )));
    $form->addElement(new Element\Number("CNPJ: ", "cnpj", array(
        "value" => "{$resultado['cnpj']}"
    )));
    $form->addElement(new Element\Number("IE: ", "ie", array(
        "value" => "{$resultado['ie']}"
    )));  
    $form->addElement(new Element\Textbox("CEP: ","cep", array(
        "value" => "{$resultado['cep']}"
    )));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco", array(
        "value" => "{$resultado['endereco']}"
    )));
    $form->addElement(new Element\Textbox("Bairro: ","bairro", array(
        "value" => "{$resultado['bairro']}"
    )));
    $form->addElement(new Element\Select("Cidade: ", "idcidade", $cidade, array(
        "value" => "{$resultado['idcidade']}"
    )));
    $form->addElement(new Element\Estado("Estado: ","idestado", array(
        "value" => "{$resultado['idestado']}"
    )));
    $form->addElement(new Element\Phone("Telefone: ", "fone", array(
        "value" => "{$resultado['fone']}"
    )));    
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1, "value" => "{$resultado['email']}"
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
