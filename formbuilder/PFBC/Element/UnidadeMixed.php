<?php
namespace PFBC\Element;

class UnidadeLong extends Select {
	public function __construct($label, $name, array $properties = null) {
		$options = array(
			"" => "--Escolha a unidade--",
                        "1" => "g - Grama",
                        "2" => "kg - Kilograma",
                        "3"  =>"ml - Mililitro",
                        "4" => "lt - Litro",
                        "5" => "cm - Centímetro",
                        "6" => "m - Metro"
); 
	parent::__construct($label, $name, $options, $properties);
    }
}
