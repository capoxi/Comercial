<?php        
    
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Transportadoras";
    $acao = "Listar";
    $titulo = "Lista de Transportadoras";
    
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
    if (!$cidade)
        $cidade += array("" => "N&atilde;o existem itens cadastrados.");
    unset($qb);
    
    $tabela='transportadora';
    $rows = 'idtransportadora,razaosocial,fantasia,idcidade,fone,email';
    $where = "ATIVO = 'S'";
    
    $qb = new dal\querybuilder($tabela,$rows,$where);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"transportadora\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"175\">Raz&atilde;o Social</th>
        <th width=\"100\">Telefone</th>
        <th width=\"150\">Email</th>
        <th width=\"200\">Cidade</th>

        <th width=\"100\">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>";
               
    while ($col = mysql_fetch_array($consulta)) {
        $html .= "
                  <tr>";
        $html .= "
                  <td>{$col['idtransportadora']}</td>";
        $html .= "
                  <td>{$col['razaosocial']}</td>";
        $html .= "
                  <td>{$col['fone']}</td>";
        $html .= "
                  <td>{$col["email"]}</td>";
        $col['idcidade'] = $cidade["{$col['idcidade']}"];
        $html .= "
                  <td>{$col["idcidade"]}</td>";
        $html .= "
                  <td>
                  <a href='../../Consultar/Transportadoras/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Transportadoras/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Transportadoras/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
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