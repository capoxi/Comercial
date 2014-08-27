<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassesVenda
 *
 * @author Douglas
 */
//abstract class Venda {
//    //put your code here
//    abstract public function adicionarProduto();
//    abstract public function definirCliente();
//    abstract public function imprimeNota();
//}

class preparaVenda {
    private $cliente;
    private $produtos = array();
    public function adicionarProduto($produto) {
        if (is_array($produto)){
            foreach ($produto as $p) {
                array_push($this->produtos, $p);
            }
        }else
            array_push($this->produtos, $produto);
    }
    public function definirCliente($cliente) {
        $this->cliente = $cliente;
    }
    public function imprimeNota(){
        if(!isset($this->cliente)||!isset($this->produtos)){
            echo "Falta informar dados.";
            return false;
        }
        echo "Cliente: {$this->cliente}\n";
        echo "Produtos: ";
        $i = 0;
        foreach ($this->produtos as $p) {
            $i++;
            echo "{$i} - {$p}";
        }
    }
}

$venda = new preparaVenda();
$produtos = array(
    '1' => 'Bacon',
    '2' => 'Salada',
    '3' => 'Mortadela'
);
$venda->adicionarProduto($produtos);
$venda->adicionarProduto(array('4' => 'Arroz'));
$venda->definirCliente('Douglas');
$venda->imprimeNota();

?>
