<?php
namespace PFBC\Element;

class SimNao extends Radio {
	public function __construct($label, $name, array $properties = null) {
		$options = array(
			"S" => "Sim",
			"N" => "N&atilde;o"
		);

		if(!is_array($properties))
			$properties = array("inline" => 1);
		elseif(!array_key_exists("inline", $properties))
			$properties["inline"] = 1;
		
		parent::__construct($label, $name, $options, $properties);
    }
}
