<?php

    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Marcas";
    $acao = "Listar";
    $titulo = "Lista de Marcas";
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
    
    $tabela='marca';
    
    $rows = '*';
    $where = "ATIVO = 'S'";
    
    $qb = new dal\querybuilder($tabela,$rows,$where);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"marca\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"220\">Nome</th>
        <th width=\"185\">Email</th>
        <th width=\"100\">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>";
    
    while ($col = mysql_fetch_array($consulta)) {
        $html .= "
                  <tr>";
        $html .= "
                  <td>{$col[0]}</td>";
        $html .= "
                  <td>{$col[1]}</td>";
        $html .= "
                  <td>{$col[2]}</td>";
        $html .= "
                  <td>
                  <a href='../../Consultar/Marcas/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Marcas/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Marcas/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
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