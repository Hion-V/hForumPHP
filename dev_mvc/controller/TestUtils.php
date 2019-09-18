<?php


class TestUtils{
    public static $log = [];
    public static $status;
    public static function log($output, $status = "OK",$addComma = false){
        $loginput = [];
        $loginput['message'] = $output;
        $loginput['status'] = $status;
        echo(json_encode($loginput));
        if($addComma){
            echo(',');
        }
        echo("\n");
        return;
    }
    public static function returnLog(){
        echo(json_encode(self::$log));
    }
}