<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dicionarioDados
 *
 * @author douglas
 */
class dicionarioDados {
    //put your code here
    private $dic;
    public function __construct(){
          $this->dic = array(
                'baby' => 'Tamara',
        );
    }
    
    public function existeChave($key){
        return array_key_exists($key, $this->dic);
    }
    
    public function getLong($short){
        
        if ($this->existeChave($short)){
            return $this->dic[$short];
        }
        return 'CNE';
    }
    
}

?>