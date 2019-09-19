<?php
class TestAction{
    function TestAction(){
        if(isset($_POST['auth'])){
            if($_POST['auth'] == getenv('ADMIN_ACTION_KEY')){
                $this->execute();
            }else{
                self::logMessage('you have no authorization to do that', 'FAILURE');
            }
        }else{
            self::logMessage('you have no authorization to do that', 'FAILURE');
        }
        self::returnLogAsText();
    }
    function execute(){
        self::logMessage('Unoverridden execute called on TestAction: '.$this, 'FAILURE');
    }
    public static $log = [];
    public static $status;
    public static function logMessage($message, $status = "OK"){
        $loginput = [];
        $loginput['message'] = $message;
        $loginput['status'] = $status;
        arr_push(self::$log, $loginput);
        return;
    }
    public static function returnLogAsJson(){
        echo(json_encode(self::$log));
        return;
    }
    public static function returnLogAsText(){
        for($i = 0; $i<sizeof(self::$log); $i++){
            echo("[".self::log[i]['stats']."] ".self::log[i]['message']);
        }
    }
}