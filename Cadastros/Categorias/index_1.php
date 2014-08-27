<?php
    
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Categorias";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
    if (isset($_POST['nome'])) {
        $tabela = 'categoria';
        $rows = 'nome,ativo';
        $nome = $_POST['nome'];
        $ativo = $_POST['ativo'];
        
        $valores = "'$nome', '$ativo'";
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
    
    $form->setFooter();
    $form->render();

    ?>
