<?php
    namespace Comercial\dal;
/**
 * Description of conexao
 *
 * @author Douglas
 */
class conexao {
    //put your code here
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $conn;
    
    public function __construct($db_host, $db_name, $db_user, $db_pass) {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }
    
    public function conectar(){
       if (!$this->conn){
            $conn = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            $this->conn = mysql_select_db($this->db_name, $conn);
        }
       return $this->conn;
    }
    
    public function desconectar(){
        if ($this->conn){
            $this->conn = mysql_close();
        }
        return true;
    }
    
}

?>
