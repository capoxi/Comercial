<?php
     /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Fornecedores";
    $titulo = "";
    
    use Comercial\dal;
    use Comercial\mundo;
    use PFBC\Form;
    use PFBC\Element;
  
    include_once '../cadastrar.inc.php';
    
    //traz transportadora
    $tabela = "transportadora";
    $rows = "idtransportadora, razaosocial";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $transportadora = $qb->consultarToArray();
       
    
    if (isset($_POST['razaosocial'])) {
        $tabela = 'fornecedor';
        $rows = 'razaosocial,fantasia,cnpj,ie,cep,endereco,bairro,
                idcidade,idestado,idtransportadora,fone,email,datacadastro,ativo';
        $razaosocial = $_POST['razaosocial'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];
        $ie = $_POST['ie'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        $idtransportadora = $_POST['idtransportadora'];
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
        '$idtransportadora',
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
    
        
    $form = new Form("cadFornecedores"); 
    $form->addElement(new Element\HTML('<legend>Cadastros > Fornecedores</legend>'));
    $form->addElement(new Element\Hidden("form", "cadFornecedores"));
    
    $form->addElement(new Element\SimNao("Ativo","ativo", array (
        "value" => 'S'
    )));
    $form->addElement(new Element\Textbox("Raz&atilde;o Social: ", "razaosocial", array(
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome Fantasia: ", "fantasia", array(
        "required" => 1
    )));
    $form->addElement(new Element\Number("CNPJ: ", "cnpj"));
    $form->addElement(new Element\Number("IE: ", "ie"));  
    $form->addElement(new Element\Hidden("CEP: ","cep"));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco"));
    $form->addElement(new Element\Textbox("Bairro: ","bairro"));
    $form->addElement(new Element\Estado("Estado: ","idestado"));
    $form->addElement(new Element\HTML("
        <span class=\"carregando\" style=\"display:none\">Carregando...</span>
        
    "));
    $form->addElement(new Element\Select("Cidade", "idcidade", array ("" => "Selecione um estado")));
    $form->addElement(new Element\Select("Transportadora: ", "idtransportadora", $transportadora));
    $form->addElement(new Element\Phone("Telefone: ", "fone"));    
    $form->addElement(new Element\Email("Email: ", "email", array(
        "required" => 1
    )));
    $form->addElement(new Element\Hidden("datacadastro", "01-01-1900 00:00"));
    $form->addElement(new Element\Button("Cadastrar"));
    $form->addElement(new Element\Button("Cancelar", "button", array(
        "onclick" => "history.go(-1);"
    )));
    $form->render();
    
//    echo "<script src=\"http://www.google.com/jsapi\"></script>
//		<script type=\"text/javascript\">
//		  google.load('jquery', '1.6.1');
//		</script>	";
    
    echo "
        <script type=\"text/javascript\">
        var estado = $(\"[name='idestado']\");
        var cidade = $(\"[name='idcidade']\");
        $(function(){
                $(estado).change(function(){
                        if( $(this).val() ) {
                                $(cidade).hide();
                                $('.carregando').show();
                                $.getJSON('../../mundo/cidades.php?idestado=',{idestado: $(this).val(), ajax: 'true'}, function(j){
                                        var options = '<option value=\"\">Escolha uma cidade</option>';	
                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value=\"' + j[i].idcidade + '\">' + j[i].nomecidade + '</option>';
                                        }	
                                        $(cidade).html(options).show();
                                        $('.carregando').hide();
                                });
                        } else {
                                $(cidade).html('<option value=\"\"> Escolha um estado </option>');
                        }
                });
        });
        </script>
        ";
    
?>
