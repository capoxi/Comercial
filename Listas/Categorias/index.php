<?php

    /**
     * Projeto Comercial
     *
     * @author Douglas Marquezin
     */

    $objeto = "Categorias";
    $acao = "Listar";
    $titulo = "Lista de Categorias";    

    include("../listar.inc.php");

	use Comercial\dal;
	use Comercial\mundo;
    $tabela='categoria';
    
    $rows = '*';
    $where = "ATIVO = 'S'";
    
    $qb = new dal\querybuilder($tabela,$rows,$where);
    
    $consulta = $qb->consultar();
    $html = "
        <table name=\"categoria\" class=\"flexme\">
        <thead>
        <tr>
        <th width=\"50\">ID</th>
        <th width=\"220\">Nome</th>
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
                  <td>
                  <a href='../../Consultar/Categorias/?codigo={$col[0]}' alt='Informações do registro'>
                  <img src='../../icons/24x24/contact-new.png'></a>
                  &nbsp;
                  <a href='../../Editar/Categorias/?codigo={$col[0]}' alt='Abrir/Editar registro'>
                  <img src='../../icons/24x24/document-open.png'></a>
                  &nbsp;
                  <a href='../../Excluir/Categorias/?codigo={$col[0]}' alt='Excluir/Inativar registro'>
                  <img src='../../icons/24x24/process-stop.png'></a>
                  </td>";
        $html .= "</tr>";
    }
    $html .= "
              </tbody>
              </table>";
              
              ?>
       
        
    <?php echo $html;

?>
        
        <script type="text/javascript">
                $('.flexme').flexigrid({
			striped : false,
                        usepager: true,
	sortname: "id",
	sortorder: "asc",
	title: 'Categorias',
	useRp: true,
	rp: 15,
	showTableToggleBtn: true,
	width: 700,
	height: 200
		});
	</script>
</body>  
    
</html>