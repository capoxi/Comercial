<?php
     
    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Produtos";
    $acao = "Listar";
    $titulo = "Lista de Produtos";
    include "../../mundo/header.inc.php"; ?>

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
    
    //traz categoria
    $tabela = "categoria";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $categoria = array();
    while ($col = mysql_fetch_array($consulta)) {
         $categoria += array("$col[0]" => "$col[1]");
    }
    if (!$categoria)
            $categoria += array("" => "Categoria inativa");
    unset($qb);
    
    //traz marca
    $tabela = "marca";
    $where = "ATIVO='S'";
    $qb = new dal\querybuilder($tabela, '*', $where);
    $consulta = $qb->consultar();
    $marca = array();
    while ($col = mysql_fetch_array($consulta)) {
        $marca += array("$col[0]" => "$col[1]");
    }
    if (!$marca)
            $marca += array("" => "Marca inativa");
    unset($qb);
    //
    
    $tabela='produto';
    $rows = 'idproduto,nome,idcategoria,idmarca,idfornecedor,
        qtdestoque,valorcompra,valorvenda';
    
    $qb = new dal\querybuilder($tabela,$rows);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"produto\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"175\">Nome</th>
        <th width=\"100\">Marca</th>
        <th width=\"150\">Categoria</th>
        <th width=\"50\">Qtd</th>
        <th width=\"100\">Valor Compra</th>
        <th width=\"100\">Valor Venda</th>
        

        <th width=\"100\">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>";
               
    while ($col = mysql_fetch_array($consulta)) {
        $html .= "
                  <tr>";
        $html .= "
                  <td>{$col['idproduto']}</td>";
        $html .= "
                  <td>{$col['nome']}</td>";
                  
        $col['idmarca'] = $marca["{$col['idmarca']}"];
        $html .= "
                  <td>{$col['idmarca']}</td>";

        $col['idcategoria'] = $categoria["{$col['idcategoria']}"];          
        $html .= "
                  <td>{$col["idcategoria"]}</td>";
        $html .="
                  <td>{$col['qtdestoque']}</td>";
        $html .="
                  <td>".number_format($col['valorcompra'],2)."</td>";
        $html .="
                  <td>".number_format($col['valorvenda'],2)."</td>";
        $html .= "
                  <td>
                  <a href='../../Consultar/Produtos/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Produtos/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Produtos/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
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