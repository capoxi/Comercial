<?php
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Transportadoras";
    $titulo = "";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
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
    
    if (isset($_POST['razaosocial'])) {
        $tabela = 'transportadora';
        $rows = 'razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
                idcidade,idestado,fone,email,datacadastro,ativo';
        $razaosocial = $_POST['razaosocial'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];
        $ie = $_POST['ie'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        $datacadastro = $_POST['datacadastro'];
        
        $ativo = $_POST['ativo'];
        
        $valores = "
        '$razaosocial',
        '$fantasia',
        '$cnpj',
        '$ie',
        '$cep',
        '$endereco',
        '$bairro',
        '$idcidade',
        '$idestado',
        '$fone',
        '$email',
        '$datacadastro',
        '$ativo'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
    }
        
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
    
    
    $form = new Form("cadTranportadoras");
    $form->addElement(new Element\HTML('<legend>Cadastros > Transportadoras</legend>'));
    $form->addElement(new Element\Hidden("form", "cadTransformadoras"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array (
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Raz&atilde;o Social: ", "razaosocial", array(
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome Fantasia: ", "fantasia", array(
        "required" => 1
    )));
    $form->addElement(new Element\Number("CNPJ: ", "cnpj"));
    $form->addElement(new Element\Number("IE: ", "ie"));  
    $form->addElement(new Element\Textbox("CEP: ","cep"));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco"));
    $form->addElement(new Element\Textbox("Bairro: ","bairro"));
    $form->addElement(new Element\Select("Cidade: ", "idcidade", $cidade));
    $form->addElement(new Element\Estado("Estado: ","idestado"));
    $form->addElement(new Element\Phone("Telefone: ", "fone"));    
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1
    )));
    $form->addElement(new Element\HiddenDateTimeNow("datacadastro"));
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
