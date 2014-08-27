<?php
namespace PFBC\Element;

class EstadoCivil extends Select {
	public function __construct(array $properties = null) {
                $label = "Estado Civil: ";
                $name = "estadocivil";
		$options = array(
                        "N" => "N&atilde;o informado",
                        "C" => "Casado",
                        "D" => "Divorciado",
                        "E" => "Noivo",
                        "S" => "Solteiro",
                        "V" => "Vi&uacute;vo"
			);
		parent::__construct($label, $name, $options, $properties);
    }
}
?>