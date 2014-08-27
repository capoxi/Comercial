<?php

    namespace PFBC\Element;

    use Comercial\dal;

class Cidade extends Select {
	public function __construct($label, $name, array $properties = null, $idestado = null) {
            if ($properties == null || $idestado == null)
                $options = array(
			"" => "-- Escolha o Estado --"
                );
             else {          
                //traz cidade
                $qb = new dal\querybuilder('cidade', 'idcidade, nomecidade', 'idestado='+$idestado);
                $consulta = $qb->consultar();
                $options = array();
                
                while ($col = mysql_fetch_array($consulta)) 
                    $options += array("$col[0]" => "$col[1]");
                if (!$options)
                    $options += array("" => "N&atilde;o existem itens cadastrados.");
                unset($qb);
             }
             parent::__construct($label, $name, $options, $properties);
             
        }                
}
?>