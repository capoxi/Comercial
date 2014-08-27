<?php
   
   namespace Comercial\dal;
   
   include_once 'commonFunc.php';

class History
{
    protected $seq;
    /*
     * a - alteração
     * d - desativar/ativar
     * i - inclusãa
     * x - exclusão
     */
    protected $tabela;
    protected $op;
    protected $datahora;
    protected $usuario;
    
    public function __construct($tabela, $id, $op)
    {        
        //$this->op = new Enum('a','d','i','x');
        $this->datahora = commonFunc::DateTimeNow();
        $this->usuario = "Sistema";   
        // ---
        $this->tabela = $tabela;
        $this->seq = $id;
        if ($op == 'a'||'d'||'i'||'x')
        {
            $this->op = $op;
        }
        else {
            throw new Exception("tipo de operação invalida", $code, $previous);
        }
    }
    
    public function RowsToInsert()
    {
        return "seq,tbl,op,datahora,usuario";
    }
    public function RowsToQuery()
    {
        return "id,seq,tbl,op,datahora,usuario";
    }
         
    public function toString()
    {
        $s = '' . 
        $this->seq .','.
        commonFunc::stringToQuery($this->tabela) .','.
        commonFunc::stringToQuery($this->op) .','.
        commonFunc::stringToQuery($this->datahora) .','.
        commonFunc::stringToQuery($this->usuario);
        
        return $s;
    }
    
    
}


