<?php 
    
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Funcionários";
    $acao = "Listar";
    $titulo = "Lista de Funcionários";
    include("../../mundo/header.inc.php"); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../grid/css/flexigrid.pack.css" />
	<script type="text/javascript"
		src="../../grid/js/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="../../grid/js/flexigrid.pack.js"></script>
    </head>
    <body>
        	<div class="code" style="visibility: hidden; display: none;">
		<pre>$('.flexme').flexigrid({height:'auto'});</pre>
                </div>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    use Comercial\dal;
    
    include '../../dal/querybuilder.php';
    
    //traz cidade
    $tabela = "cidade";
    $rows = "idcidade, nomecidade, nomeestado";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, $rows, $where);
    $consulta = $qb->consultar();
    $cidade = array();
    
    while ($col = mysql_fetch_array($consulta)) 
        $cidade += array("$col[0]" => "$col[1] ($col[2])");
      
    $tabela='funcionario';
    $rows = 'idfuncionario,nome,login,idcidade,idestado';
    $where = "ATIVO = 'S'";
    
    $qb = new dal\querybuilder($tabela,$rows,$where);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"funcionario\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"220\">Nome</th>
        <th width=\"150\">Email</th>
        <th width=\"220\">Cidade</th>
        

        <th width=\"100\">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>";
    
    while ($col = mysql_fetch_array($consulta)) {
        $html .= "
                  <tr>";
        $html .= "
                  <td>{$col['idfuncionario']}</td>";
        $html .= "
                  <td>{$col['nome']}</td>";
        $html .= "
                  <td>{$col['login']}</td>";
        $col['idcidade'] = $cidade["{$col['idcidade']}"];          
        
        $html .= "
                  <td>{$col['idcidade']}</td>";
        $html .= "
                  <td>
                  <a href='../../Consultar/Funcionarios/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Funcionarios/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Funcionarios/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
                  <img src='../../icons/24x24/process-stop.png'></a>
                  </td>";
        $html .= "</tr>";
    }
    $html .= "
              </tbody>
              </table>";
    echo "$html";

?>
        
        <script type="text/javascript">
                $('.flexme').flexigrid({
			height : 'auto',
			striped : false
		});
	</script>
</body>  
    
</html>