<?php 

    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Fornecedores";
    $acao = "Listar";
    $titulo = "";
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
    
    //traz transportadora
    $tabela = "transportadora";
    //$rows = "idtransportadora, razaosocial, fantasia";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $transportadora = array();
    
    while ($col = mysql_fetch_array($consulta)) 
        $transportadora += array("$col[0]" => "$col[1]");
    
    //
    $tabela='fornecedor';
    $rows = 'idfornecedor,razaosocial,fantasia,fone,email,idtransportadora';
    $where = "ATIVO = 'S'";
    
    $qb = new dal\querybuilder($tabela,$rows,$where);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"fornecedor\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"175\">Raz&atilde;o Social</th>
        <th width=\"100\">Telefone</th>
        <th width=\"150\">Email</th>
        <th width=\"220\">Transportadora</th>
        

        <th width=\"100\">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>";
               
    while ($col = mysql_fetch_array($consulta)) {
        $html .= "
                  <tr>";
        $html .= "
                  <td>{$col['idfornecedor']}</td>";
        $html .= "
                  <td>{$col['razaosocial']}</td>";
        $html .= "
                  <td>{$col['fone']}</td>";
        $html .= "
                  <td>{$col["email"]}</td>";
      /* @var $col atribui o idtransportadora ao indice do array de transportadoras
       * TODO: buscar somente a transportadora referenciada */
        $col['idtransportadora'] = $transportadora["{$col['idtransportadora']}"];          
        $html .="
                  <td>{$col['idtransportadora']}</td>";
        $html .= "
                  <td>
                  <a href='../../Consultar/Fornecedores/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Fornecedores/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Fornecedores/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
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