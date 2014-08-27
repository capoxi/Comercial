<?php
    
    
    
    
    use Comercial\dal;
    use PFBC\Form;
    use PFBC\Element;

    include("../../formbuilder/PFBC/Form.php");
    include("../../mundo/header.inc.php");  
    include("../../mundo/checkCadastros.inc.php");
    include '../../dal/querybuilder.php';
    
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
    
   //traz transportadora
    $tabela = "transportadora";
    //$rows = "idtransportadora, razaosocial, fantasia";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $transportadora = array();
    
    while ($col = mysql_fetch_array($consulta)) 
        $transportadora += array("$col[0]" => "$col[1] ($col[2])");
        
    if (!$transportadora)
            $transportadora += array("" => "N&atilde;o h&aacute; itens cadastrados.");
    unset($qb);
    
    $tabela = 'fornecedor';
    $rows = 'idfornecedor,razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
            idcidade,idestado,idtransportadora,fone,email';
    $where = "idfornecedor = '$codigo'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
  
    $form = new Form("editFornecedores");
    
    $form->configure(array(
        "action" => "processar.php"
    ));
    $form->addElement(new Element\HTML('<legend>Editar > Fornecedores</legend>'));
    $form->addElement(new Element\Hidden("form", "editFornecedores"));
    
    $form->addElement(new Element\Hidden("codigo","idfornecedor"));
    
    $form->addElement(new Element\Textbox("Raz&atilde;o Social: ", "razaosocial", array(
        "required" => 1, "value" => "{$resultado['razaosocial']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Textbox("Nome Fantasia: ", "fantasia", array(
        "required" => 1, "value" => "{$resultado['fantasia']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("CNPJ: ", "cnpj", array(
        "value" => "{$resultado['cnpj']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("IE: ", "ie", array(
        "value" => "{$resultado['ie']}", "readonly" => "true"
    )));  
    $form->addElement(new Element\Textbox("CEP: ","cep", array(
        "value" => "{$resultado['cep']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco", array(
        "value" => "{$resultado['endereco']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Textbox("Bairro: ","bairro", array(
        "value" => "{$resultado['bairro']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Cidade: ", "idcidade", $cidade, array(
        "value" => "{$resultado['idcidade']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Estado("Estado: ","idestado", array(
        "value" => "{$resultado['idestado']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Transportadora: ", "idtransportadora", $transportadora, array(
        "value" => "{$resultado['idtransportadora']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Phone("Telefone: ", "fone", array(
        "value" => "{$resultado['fone']}", "readonly" => "true"
    )));    
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1, "value" => "{$resultado['email']}", "readonly" => "true"
    )));
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
