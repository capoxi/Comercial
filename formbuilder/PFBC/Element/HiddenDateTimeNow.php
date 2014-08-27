<?php
namespace PFBC\Element;

class HiddenDateTimeNow extends Hidden {
	public function __construct($name = null, array $properties = null) {
		if(is_null($name)) {
                    echo "Erro ao instanciar o objeto.";
                    return false;
                }
                $value = date("Y-m-d H:i:s");
                
		parent::__construct($name, $value, $properties);
    }
}
?>