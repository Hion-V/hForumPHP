<?php


class TestUtils{
    public static $log = [];
    public static $status;
    public static function log($output, $status = "OK"){
        $loginput = [];
        $loginput['message'] = $output;
        $loginput['status'] = $status;
        array_push(self::log, $loginput);
    }
    public static function returnLog(){
        echo(json_encode(self::$log));
    }
}