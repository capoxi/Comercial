<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of checkCadastros
 *
 * @author Douglas
 */
class checkCadastros {
    //put your code here
    private $acao;
    
    public function __construct($acao) {
        $this->acao = $acao;
    }
            
    public function chkGetCodigo() {
        if (!isset($_POST['codigo']) and !isset($_GET['codigo'])) {
            echo "<span class=\"menuBotaoErr\"><a href=\"#\">A fun&ccedil;&atilde;o <b>{$this->acao}</b> n&atilde;o pode ser acessada diretamente!&nbsp;";
            echo "Utilize a lista e selecione um registro para {$this->acao}.</a></span>";
            return false;
        }
        return true;
    }
}

?>
