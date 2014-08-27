<?php

    $d = $_SERVER['DOCUMENT_ROOT'];
    $acao = "Cadastrar";
    
    include($d."/Comercial/formbuilder/PFBC/Form.php");
    include($d."/Comercial/mundo/mensagens.inc.php");
	 include("../mundo/header.inc.php");
    include('../dal/querybuilder.php');
