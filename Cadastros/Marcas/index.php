<?php
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Marcas";
    $titulo = "";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
    if (isset($_POST['nome']) and isset($_POST['email'])) {
        $tabela = 'marca';
        $rows = 'nome,email,ativo';
        $valor1 = $_POST['nome'];
        $valor2 = $_POST['email'];
        $ativo = $_POST['ativo'];
        
        $valores = "'$valor1', '$valor2','$ativo'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
        
        }
    
    $form = new Form($acao.$objeto);
    
    $form->setHeader();
    
    $form->addElement(new Element\Textbox("Nome:", "nome", array(
        "required" => 1
    )));
    $form->addElement(new Element\Email("Email", "email", array(
        "required" => 1
    )));
    
    $form->setFooter();
            
    $form->render();

?>
