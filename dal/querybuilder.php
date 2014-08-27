<?php

    namespace Comercial\dal;
    
    include 'conexao.php';
    include 'history.php';

/**
 * Description of querybuilder
 *
 * @author Douglas
 */
class querybuilder {
    //put your code here
    private $tabela;
    private $rows;
    private $where;
    private $order;
    private $valores;
    private $apagar; //  0 - inativa cadastro, 1 - exclui
    private $conecta;
    private $imprimemensagens;
    
    private $query;
    
    public function __construct($tabela,$rows = '*',$where = null,  $valores = null, $order = null) {
        if ($tabela == null){
            return false;
        }
        else {
            $this->tabela = $tabela;
            $this->rows = $rows;
            $this->where = $where;
            $this->order = $order;
            $this->valores = $valores;
            $this->query = null;
            
            //objetos do banco
            $host = 'localhost';
            $db = 'vendas';
            $user = 'root';
            $pass = 'mods2his';
            $this->conecta = new conexao($host,$db,$user,$pass);
            $this->imprimemensagens = "N";
        
            
        }
    }
    
    public function consultar() {
        $this->query = "SELECT $this->rows FROM $this->tabela";
        /* @var $resultado mysql_resource */
        $resultado = $this->extConsulta($this->query);
        return $resultado;
    }
    
    public function consultarToArray() {
        $this->query = "SELECT $this->rows FROM $this->tabela";
        /* @var $resultado mysql_resource */
        $consulta = $this->extConsulta($this->query);
        $resultado = array();
    
        while ($col = mysql_fetch_array($consulta)) 
            $resultado += array("$col[0]" => "$col[1]");
        
        if (!$resultado)
            $resultado+= array("" => "N&atilde;o h&aacute; itens cadastrados");
        return $resultado;
    }
    
    public function inserir() {
        if ($this->valores == null) {
            return 'erro';
        }
        $this->query = "INSERT INTO $this->tabela ($this->rows) VALUES ($this->valores)";
        /* @var $resultado boolean */
        $resultado = $this->extConsulta($this->query);
        if (($resultado) && ($this->tabela !== "historico")) {
            $this->WriteHistory($this->tabela, mysql_insert_id(), 'i');
        }
        return $resultado;
    }
    
    public function atualizar($id = 0) {
        $this->query = "UPDATE $this->tabela SET $this->valores";
        $resultado = $this->extConsulta($this->query);

        if (($resultado) && ($id !== 0)) {
            $this->WriteHistory($this->tabela, $id, 'a');
        }
        return $resultado;        
    }
    
    public function desativar($id = 0) {
//        if ($apagar !== 0 or $apagar !== 1) {
//            return false;
//        }
//        if ($this->where == null) {
//            return false;
//        }
//        if (apagar == 0) {
            //$this->where = "ATIVO = 'N'";
            $this->query = "UPDATE $this->tabela SET $this->valores";
            $resultado = $this->extConsulta($this->query);         
            
            if (($resultado) && ($id !== 0)) {
                $this->WriteHistory($this->tabela, $id, 'd');
            }               
            return $resultado;
    }
//        if (apagar == 1) {
//            $query = "DELETE $this->tabela";
//            $resultado = $this->extConsulta($query);
//            if (!resultado) {
//                echo "Ocorreu um erro ao extender a consulta.";
//            }
        
    public static function WriteHistory($table, $id, $op)
    {
        $historico = new History($table, $id, $op);
        $rows = 'seq,tbl,op,datahora,usuario';
        $qb = new querybuilder("historico", $historico->RowsToInsert(), null, $historico->toString());
        $id = $qb->inserir();
        return (is_numeric($id))? TRUE : FALSE;
    }
    
    public function extConsulta() {
        if (!$this->where == null){
            $this->query .= " WHERE $this->where";
        }
        if (!$this->order == null) {
            $this->query .= " ORDER BY $this->order";
        }
        $this->conecta->conectar();
        $resultado = mysql_query($this->query);
        
        //echo "A query: $this->query, O RESULTADO: $resultado";
                
        if($this->query !== null and $this->imprimemensagens !== 'N') {
            echo "<span class=\"menuBotao\" id=\"mensagem\"><a href=\"#\">Opera&ccedil;&atilde;o executada com sucesso.</a></span>";
        }
        if (!$resultado){
            echo "<span class=\"menuBotaoErr\" id=\"mensagem\">"
            . "<a href=\"#\">Ocorreu um erro em extender a consulta.</a>"
            . "<code>".$this->query."</code></span>";
        }
        //$this->conecta->desconectar();
        return $resultado;
    }
}


    
?>
