<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    ///se não existir sessão, cria uma
    if ((session_status() < 2))
        { session_start(); }
     
    if (!isset($titulo) || (isset($titulo) && $titulo == "")) 
    {$titulo=$acao."&nbsp;".$objeto;}
    echo "<title>".$titulo."</title>";   
    echo "<meta charset=\"utf-8\"/>";
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"/Comercial/mundo/menu.css\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://localhost:8080/Comercial/formbuilder/bootstrap/css/bootstrap-combined.min.css\" />";
    echo "<link href=\"/Comercial/formbuilder/prettify/prettify.css\" rel=\"stylesheet\">";
    echo "<script src=\"/Comercial/formbuilder/prettify/prettify.js\"></script>";
    echo "<div id=\"logo\"><img src=\"/Comercial/mundo/logo.png\" /></div>";
    include ("menu.inc.php");
    echo "<p><h3>$titulo</b></h3></p>";
?>
