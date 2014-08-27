<?php
        use Comercial\dal;
        include '../dal/querybuilder.php';
        
        header( 'Cache-Control: no-cache' );
	//header( 'Content-type: application/xml; charset="utf-8"', true );
        header( 'Content-type: application/json; charset="utf8"', true);
	
	//$idestado = mysql_real_escape_string( $_REQUEST['idestado'] );
        
        if (!isset($_GET['idestado']))
        {return $cidade[] = array(
                'idcidade' => null,
                'nomecidade' => 'Selecione um estado.'
            );}
        
        $idestado = $_GET['idestado'];
        
            
        $qb = new dal\querybuilder("cidade", "idcidade, nomecidade", "idestado=$idestado", null, "nomecidade");
	$consulta = $qb->consultar();
        
        while ($row = mysql_fetch_assoc($consulta)) {
            $cidade[] = array(
                'idcidade' => $row['idcidade'],
                'nomecidade' => htmlentities($row['nomecidade']),
                );
            //echo "cidade {$row['idcidade']} nome {$row['nomecidade']}";
        }
        if(!isset($cidade)) {
            $cidade[] = array(
                'idcidade' => null,
                'nomecidade' => 'N&atilde;o h&aacute; itens cadastrados'
            );
        }
	echo( json_encode( $cidade ) );
        
?>