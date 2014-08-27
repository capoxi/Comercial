<?php
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Funcion&aacute;rios";
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
        $tabela = 'funcionario';
        $rows = 'login,senha,nome,cpf,rg,cep,endereco,bairro,
                idcidade,idestado,ativo';
        
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $idcidade = $_POST['idcidade'];
        $idestado = $_POST['idestado'];
        
        $ativo = $_POST['ativo'];
        
        $valores = "
        '$login',
        '$senha',
        '$nome',
        '$cpf',
        '$rg',
        '$cep',
        '$endereco',
        '$bairro',
        '$idcidade',
        '$idestado',
        '$ativo'";
        $qb = new dal\querybuilder($tabela, $rows, null, $valores);
        if ($qb->inserir())
        {  echo mundo\commonMsg::montaMensagem("sucesso");}
        else 
        {  echo mundo\commonMsg::montaMensagem("erro");}
    }
    
    $ativo = array("S" => "Sim", "N" => "N&atilde;o");
  
    $form = new Form("cadfuncionario");
    $form->addElement(new Element\HTML('<legend>Cadastros > Funcion&aacute;rios</legend>'));
    $form->addElement(new Element\Hidden("form", "cadfuncionario"));
    
    $form->addElement(new Element\Radio("Ativo","ativo",$ativo, array(
        "required" => 1
    )));
    $form->addElement(new Element\Textbox("Nome: ", "nome", array(
        "required" => 1
    )));
    $form->addElement(new Element\Number("CPF: ", "cpf"));
    $form->addElement(new Element\Number("RG: ", "rg"));
    $form->addElement(new Element\Textbox("Endere&ccedil;o: ", "endereco"));
    $form->addElement(new Element\Textbox("Bairro: ","bairro"));  
    $form->addElement(new Element\Number("CEP: ","cep"));
    $form->addElement(new Element\Estado("Estado: ", "idestado"));
    $form->addElement(new Element\Select("Cidade: ", "idcidade", array(
        "" => "-- Escolha o Estado --"
    )));
    $form->addElement(new Element\Phone("Telefone: ", "fone"));
    $form->addElement(new Element\Email("Login: ", "login", array(
        "required" => 1
    )));
    $form->addElement(new Element\Password("Senha", "senha", array(
        "required" => 1
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
       echo "
        <script type=\"text/javascript\">
		$(function(){
			$(\"[name='idestado']\").change(function(){
				if( $(this).val() ) {
					$(\"[name='idcidade']\").hide();
					$('.carregando').show();
					$.getJSON('../../mundo/cidades.php?idestado=',{idestado: $(this).val(), ajax: 'true'}, function(j){
						if(j.length == 'undefined') {
                                                    options = '<option value=\"\">Não há cidades cadastradas</option>';
						}
                                                else {
                                                    options = '<option value=\"\">-- Escolha a cidade --</option>';	
                                                    for (var i = 0; i < j.length; i++) {
                                                            options += '<option value=\"' + j[i].idcidade + '\">' + j[i].nomecidade + '</option>';
                                                    }
                                                }
                                                $(\"[name='idcidade']\").html(options).show();
						$('.carregando').hide();
					});
				} else {
					$(\"[name='idcidade']\").html('<option value=\"\"> Escolha um estado </option>');
				}
			});
		});
		</script>
                ";
?>
