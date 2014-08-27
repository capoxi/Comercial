<?php
        /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Cidades";
    $titulo = "";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
    if (isset($_POST['codigo']) and isset($_POST['nome'])) {
        $tabela = 'cidade';
        $valor1 = $_POST['codigo'];
        //$valor2 = $_POST['nomeestado'];
        //um pouco de bruxaria
        $estados = Array(
            11	=>	'Rond&ocirc;nia',
            12	=>	'Acre',
            13	=>	'Amazonas',
            14	=>	'Roraima',
            15	=>	'Par&aacute;',
            16	=>	'Amap&aacute;',
            17	=>	'Tocantins',
            21	=>	'Maranh&atilde;o',
            22	=>	'Piau&iacute;',
            23	=>	'Cear&aacute;',
            24	=>	'Rio Grande do Norte',
            25	=>	'Para&iacute;ba',
            26	=>	'Pernambuco',
            27	=>	'Alagoas',
            28	=>	'Sergipe',
            29	=>	'Bahia',
            31	=>	'Minas Gerais',
            32	=>	'Esp&iacute;    rito Santo',
            33	=>	'Rio de Janeiro',
            35	=>	'São Paulo',
            41	=>	'Paran&aacute;',
            42	=>	'Santa Catarina',
            43	=>	'Rio Grande do Sul',
            50	=>	'Mato Grosso do Sul',
            51	=>	'Mato Grosso',
            52	=>	'Goi&aacute;s',
            53	=>	'Distrito Federal');
        $valor2 = $_POST['codigo'];
        $valor2 = $estados[$valor2];
        $valor3 = 1;
        $valor4 = $_POST['nome'];
        
        $ativo = $_POST['ativo'];
        
        $rows = 'idestado,nomeestado,idcidade,nomecidade,ativo';
        $valores = "$valor1, '$valor2', $valor3,'$valor4','$ativo'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
    }
    
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
   
    $form = new Form("login");
    $form->addElement(new Element\HTML('<legend>Cadastros > Cidades</legend>'));
    $form->addElement(new Element\Hidden("form", "cidades"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array(
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome:", "nome", array(
        "required" => 1
    )));
    $form->addElement(new Element\Estado("Estado:","codigo", array(
        "required" => 1)));
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
