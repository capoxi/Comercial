<?php
     
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Cliente";
    
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
    $estadocivil = array(
        "N" => "N&atilde;o informado",
        "C" => "Casado",
        "D" => "Divorciado",
        "E" => "Noivo",
        "S" => "Solteiro",
        "V" => "Vi&uacute;vo"
    );
    
    $form = new Form("editarclientes");
    $form->configure( array(
        "action" => "processar.php"
    ));
   
    $form->addElement(new Element\HTML('<legend>Excluir > Clientes</legend>'));
    $form->addElement(new Element\Hidden("form", "editarclientes"));
    $form->addElement(new Element\Hidden("codigo", $codigo));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1, "value" => "{$resultado['nome']}"
    )));
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1, "value" => "{$resultado['email']}"
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
    $form->addElement(new Element\Number("CEP: ", "cep", array(
        "value" => $resultado['cep']
    )));
    //$form->addElement(new Element\Hidden("idestado","53"));
    $form->addElement(new Element\Estado("Estado: ","idestado", array(
        "value" => "{$resultado['idestado']}"
    )));
    $form->addElement(new Element\Cidade("Cidade: ","idcidade", array(
        "value" => "{$resultado['idcidade']}"
    ),$resultado['idestado']));
    $form->addElement(new Element\Number("Telefone: ", "fone", array(
        "value" => "{$resultado['fone']}"
    )));
    $form->addElement(new Element\Date("Data de Nascimento","datanascimento", array(
        "value" => "{$resultado['datanascimento']}"
    )));
//    $form->addElement(new Element\Radio("Sexo: ", "sexo", $sexo, array(
//        "value" => "{$resultado['sexo']}"
//    )));
        $form->addElement(new Element\RadioSexo(array(
            "value" => "{$resultado['sexo']}",
        )));
    $form->addElement(new Element\Select("Estado Civil: ", "estadocivil", $estadocivil, array(
        "value" => "{$resultado['estadocivil']}"
    )));
    $form->addElement(new Element\Button("Cadastrar"));
    $form->addElement(new Element\Button("Cancelar", "button", array(
        "onclick" => "history.go(-1);"
    )));
    $form->render();
    include "../../mundo/jsCidades.inc.php";
    
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
