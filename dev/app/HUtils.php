<?php
Class HUtils{
    static function issetPost($arr_postvars){
        for ($i=0; $i <sizeof($arr_postvars) ; $i++) 
        { 
            if(!isset($_POST[$arr_postvars[$i]])){
                return false;
            }
        }
        return true;
    }
    static function issetSession($arr_sessionvars)
    {
        for ($i=0; $i <sizeof($arr_sessionvars) ; $i++) { 
            if(!isset($_POST[$arr_sessionvars[$i]])){
                return false;
            }
        }
        return true;
    }
    static function sqlDateToPhpDate($date){
        
        return new DateTime($date);
    }
}
?>