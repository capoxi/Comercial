<?php
namespace PFBC\Element;

class UnidadeLong extends Select {
	public function __construct($label, $name, array $properties = null) {
		$options = array(
			"" => "--Escolha a unidade--",
                        "1" => "g",
                        "2" => "kg",
                        "3"  =>"ml",
                        "4" => "lt",
                        "5" => "cm",
                        "6" => "m"
); 
	parent::__construct($label, $name, $options, $properties);
    }
}
