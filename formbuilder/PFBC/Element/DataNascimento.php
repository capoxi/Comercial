<?php

namespace PFBC\Element;

/**
 * Description of DataNascimento
 *
 * @author Douglas
 */
class DataNascimento extends Date{
    //put your code here
    public function __construct(array $properties = null)
    {
        $label = "Data de Nascimento: ";
        $name = "datanascimento";
        
        parent::__construct($label, $name, $properties);
    }
}

?>
