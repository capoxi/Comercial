<?php
    include ("./dicionarioDados.inc.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testDic
 *
 * @author douglas
 */
    $dic = new dicionarioDados();
    $bah = $dic->getLong("baby");
    echo $bah;

?>