<?php

namespace Comercial\dal;
    
/**
 * Description of commonFunc
 *
 * @author douglas
 */

class commonFunc {
   
   public static function getServerNamePort()
    {
        return $_SERVER["SERVER_NAME"] .":".$_SERVER["SERVER_PORT"];
    }
    
    public static function DateTimeNow()
    {
        return date("Y-m-d H:i:s");
    }
    
    public static function stringToQuery($str){ return '\''.$str.'\'';}
    
    public static function stringPar($str, $left = true, $right = true)
    {return ($left ? "(" : "") . $str . ($right ? ")" : "");}
    
}

