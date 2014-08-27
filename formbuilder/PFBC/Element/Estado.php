<?php
namespace PFBC\Element;

class Estado extends Select {
	public function __construct($label, $name, array $properties = null) {
		$options = array(
			"" => "--Escolha o Estado--",
                        12	=>	'Acre',
                        27	=>	'Alagoas',
                        16	=>	'Amap&aacute;',
                        13	=>	'Amazonas',
                        29	=>	'Bahia',
                        23	=>	'Cear&aacute;',
                        53	=>	'Distrito Federal',
                        52	=>	'Goi&aacute;s',
                        32	=>	'Esp&iacute;rito Santo',
                        21	=>	'Maranh&atilde;o',
                        51	=>	'Mato Grosso',
                        50	=>	'Mato Grosso do Sul',
                        31	=>	'Minas Gerais',
                        15	=>	'Par&aacute;',
                        25	=>	'Para&iacute;ba',
                        41	=>	'Paran&aacute;',
                        26	=>	'Pernambuco',
                        22	=>	'Piau&iacute;',
                        33	=>	'Rio de Janeiro',
                        24	=>	'Rio Grande do Norte',
                        43	=>	'Rio Grande do Sul',
			11	=>	'Rond&ocirc;nia',
                        14	=>	'Roraima',
                        42	=>	'Santa Catarina',
                        35	=>	'S&atilde;o Paulo',
                        28	=>	'Sergipe',
                        17	=>	'Tocantins',
			);
		parent::__construct($label, $name, $options, $properties);
    }
}
?>