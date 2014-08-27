<?php
    
    $objeto = "Funcionario";
    
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
    
    //traz funcionario
    $tabela = 'funcionario';
    $rows = 'login,senha,nome,cpf,rg,cep,endereco,
            bairro,idcidade,idestado';
    $qb = new dal\querybuilder($tabela,$rows);
    $resultado = $qb->consultar();
    $resultado = mysql_fetch_array($resultado);
     
    $form = new Form("editFuncionario");
    $form->configure(array(
        "action" => "processar.php"
    ));
    $form->addElement(new Element\HTML('<legend>Editar > Funcion&aacute;rios</legend>'));
    $form->addElement(new Element\Hidden("form", "editFuncionario"));
    
    $form->addElement(new Element\Hidden("codigo","idfuncionario"));
    
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1, "value" => "{$resultado['nome']}"
    )));
    $form->addElement(new Element\Number("CPF: ", "cpf", array(
        "value" => "{$resultado['cpf']}"
    )));
    $form->addElement(new Element\Number("RG: ", "rg", array(
        "value" => "{$resultado['rg']}"
    )));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco", array(
        "value" => "{$resultado['endereco']}"
    )));
    $form->addElement(new Element\Textbox("Bairro: ","bairro", array(
        "value" => "{$resultado['bairro']}"
    )));  
    $form->addElement(new Element\Number("CEP: ","cep", array(
        "value" => "{$resultado['cep']}"
    )));
    $form->addElement(new Element\Select("Cidade: ", "idcidade",$cidade, array(
        "value" => "{$resultado['idcidade']}"
    )));
    $form->addElement(new Element\Estado("Estado: ", "idestado", array(
        "value" => "{$resultado['idestado']}"
    )));
//    $form->addElement(new Element\Phone("Telefone: ", "fone", array(
//        "value" => "{$resultado['fone']}"
//    )));
    $form->addElement(new Element\Email("Login: ", "login", array(
        "required" => 1, "value" => "{$resultado['login']}", "readonly" => "true"
    )));
    $form->addElement(new Element\Password("Senha", "senha", array(
        "required" => 1, "readonly" => "true", "value" => "{$resultado['senha']}"
    )));
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
