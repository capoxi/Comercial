<?php
    
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Cliente";
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
    
    $tabela = 'cliente';
    $rows = 'nome,email,cpf,rg,cep,endereco,bairro,
                idcidade,idestado,fone,datanascimento,
                sexo,estadocivil';
    $where = "idcliente='$codigo'";    
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
    
    //sexo longo
    $sexo = array(
        "M" => "Masculino",
        "F" => "Feminino"
    );
    $estadocivil = array(
        "N" => "N&atilde;o informado",
        "C" => "Casado",
        "D" => "Divorciado",
        "E" => "Noivo",
        "S" => "Solteiro",
        "V" => "Vi&uacute;vo"
    );
    
    $form = new Form("excluirclientes");
    $form->configure( array(
        "action" => "processar.php"
    ));
   
    $form->addElement(new Element\HTML('<legend>Excluir > Clientes</legend>'));
    $form->addElement(new Element\Hidden("form", "excluirclientes"));
    $form->addElement(new Element\Hidden("codigo", $codigo));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "value" => "{$resultado['nome']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Email("Email: ", "email", array(
        "value" => "{$resultado['email']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("CPF: ", "cpf", array(
         "value" => "{$resultado['cpf']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("RG: ", "rg", array(
         "value" => "{$resultado['rg']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco", array(
         "value" => "{$resultado['endereco']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Textbox("Bairro: ","bairro", array(
         "value" => "{$resultado['bairro']}", "readonly" => "true"
    )));  
    $form->addElement(new Element\Hidden("cep","1"));
    ////cidade fixa em 1;
    $form->addElement(new Element\Select("Cidade: ", "idcidade", $cidade, array(
        "selected" => "{$resultado['idcidade']}", "readonly" => "true"
    )));
    //$form->addElement(new Element\Hidden("idestado","53"));
    $form->addElement(new Element\Estado("Estado: ","idestado", array(
        "value" => "{$resultado['idestado']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Number("Telefone: ", "fone", array(
        "value" => "{$resultado['fone']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Date("Data de Nascimento","datanascimento", array(
        "value" => "{$resultado['datanascimento']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Radio("Sexo: ", "sexo", $sexo, array(
        "value" => "{$resultado['sexo']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Select("Estado Civil: ", "estadocivil", $estadocivil, array(
        "value" => "{$resultado['estadocivil']}", "readonly" => "true"
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
