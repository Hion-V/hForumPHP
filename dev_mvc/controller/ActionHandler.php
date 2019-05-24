<?php
class ActionHandler
{
    static function doAction(){
        $action = '';
        
        if(isset($_GET['action'])){
            $action = $_GET['action'];   
        }
        if(!$action == ''){
            include_once("./model/actions/model_".$action.".php");
            
        }
    }
}
?>