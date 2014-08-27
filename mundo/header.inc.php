<?php
	// se não existir sessão, cria uma
    if ((session_status() < 2))
        { session_start(); } 
 ?>
<!DOCTYPE html>
<html lang="pt_BR">
  <head>
  	<meta http-equiv="Content-Type" content="text/html">
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="pt_BR">
<?php
    
    $d = $_SERVER['DOCUMENT_ROOT'];
      
    if (!isset($titulo) || (isset($titulo) && $titulo == "")) 
      {$titulo=$acao."&nbsp;".$objeto;}
    
    echo "<title>".$titulo."</title>";   
    echo "<meta charset=\"utf-8\"/>";
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"/Comercial/mundo/menu.css\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Comercial/formbuilder/bootstrap/css/bootstrap-combined.min.css\" />";
    ?>
    <link href="/Comercial/mundo/facebox/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="/Comercial/mundo/facebox/lib/jquery.js" type="text/javascript"></script>
  <script src="/Comercial/mundo/facebox/src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '/Comercial/mundo/facebox/src/loading.gif',
        closeImage   : '/Comercial/mundo/facebox/src/closelabel.png'
      })
    })
  </script>
    <?php
    echo "<link href=\"/Comercial/formbuilder/prettify/prettify.css\" rel=\"stylesheet\">";
    echo "<script src=\"/Comercial/formbuilder/prettify/prettify.js\"></script>";
    echo "</head>";
