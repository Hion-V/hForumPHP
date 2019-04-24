<?php
Class HUtils{
    const FETCHGET = 0;
    const FETCHPOST = 1;
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
    static function getPage($fetchmethod){
        $p = "";
        if($fetchmethod == HUtils::FETCHGET){
            if(isset($_GET['p'])){
                $p = $_GET['p'];               
            }
        }
        else if($fetchmethod == HUtils::FETCHPOST){
            if(isset($_POST['p']))
            {
                $p = $_POST['p'];
            }
        }
        return $p;
    }
    static function getSiteTitle(){
        return "hPHPForum";
    }
}
?>