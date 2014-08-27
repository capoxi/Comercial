<?php
        /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Clientes";
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
    
    if (isset($_POST['nome'])) {
        $tabela = 'cliente';
        $rows = 'nome,email,cpf,rg,cep,endereco,bairro,
                idcidade,idestado,fone,datanascimento,
                sexo,estadocivil,datacadastro,ativo';
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        $fone = $_POST['fone'];
        $datanascimento = $_POST['datanascimento'];
        $sexo = $_POST['sexo'];
        $datacadastro = $_POST['datacadastro'];
        $ativo = $_POST['ativo'];
        $estadocivil = $_POST['estadocivil'];
        
        $valores = "
        '$nome',
        '$email',
        '$cpf',
        '$rg',
        '$cep',
        '$endereco',
        '$bairro',
        '$idcidade',
        '$idestado',
        '$fone',
        '$datanascimento',
        '$sexo',
        '$estadocivil',
        '$datacadastro',
        '$ativo'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
    }  
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
    
    $form = new Form("cadclientes");
    $form->addElement(new Element\HTML('<legend>Cadastros > Clientes</legend>'));
    $form->addElement(new Element\Hidden("form", "cadclientes"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array(
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1
    )));
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1
    )));
    $form->addElement(new Element\Number("CPF: ", "cpf"));
    $form->addElement(new Element\Number("RG: ", "rg"));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco"));
    $form->addElement(new Element\Textbox("Bairro: ","bairro"));  
    $form->addElement(new Element\Number("CEP: ","cep"));
    $form->addElement(new Element\Select("Cidade: ", "idcidade", $cidade));
    $form->addElement(new Element\Estado("Estado: ","idestado"));
    $form->addElement(new Element\Number("Telefone: ", "fone"));
    $form->addElement(new Element\DataNascimento());
    $form->addElement(new Element\RadioSexo());
    $form->addElement(new Element\EstadoCivil());
    //$form->addElement(new Element\Hidden("datacadastro", "01-01-1900 00:00"));
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
