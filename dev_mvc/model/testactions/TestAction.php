<?php
class TestAction{
    function __construct(){
        if(isset($_POST['auth'])){
            if($_POST['auth'] == getenv('ADMIN_ACTION_KEY')){
                $this->execute();
            }else{
                self::logMessage('you have no authorization to do that', 'FAILURE');
            }
        }else{
            self::logMessage('you have no authorization to do that', 'FAILURE');
        }
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
        array_push(self::$log, $loginput);
        return;
    }
    public static function returnLogAsJson(){
        echo(json_encode(self::$log));
        return;
    }
    public static function returnLogAsText(){
        for($i = 0; $i<sizeof(self::$log); $i++){
            echo("[".self::$log[$i]['status']."] ".self::$log[$i]['message']."\n");
            if(self::$log[$i]['status'] == 'FAILURE'){
                echo('<div id="test_exitstatus">ACTION FAILED</div>');
                return;
            }
        }
        echo('<div id="test_exitstatus">ACTION SUCCESSFUL</div>');
    }
}