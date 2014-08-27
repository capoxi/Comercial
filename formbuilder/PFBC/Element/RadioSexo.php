<?php

namespace PFBC\Element;
/**
 * Description of RadioSexo
 *
 * @author Douglas
 */

class RadioSexo extends Radio {
    //put your code here
    
    public function __construct(array $properties = null)
    {
        $label = 'Sexo: ';
        $name = 'sexo'; 
        $options = array(
        "M" => "Masculino",
        "F" => "Feminino"
        );
    parent::__construct($label, $name, $options, $properties);
    }
}

?>
