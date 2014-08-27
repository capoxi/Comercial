<?php
namespace PFBC\Element;

class UnidadeLong extends Select {
	public function __construct($label, $name, array $properties = null) {
		$options = array(
			"" => "--Escolha a unidade--",
                        "1" => "Grama",
                        "2" => "Kilograma",
                        "3"  =>"Mililitro",
                        "4" => "Litro",
                        "5" => "Centímetro",
                        "6" => "Metro"
);
		parent::__construct($label, $name, $options, $properties);
    }
}
