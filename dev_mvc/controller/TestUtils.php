<?php


class TestUtils{
    public static $log = [];
    public static $status;
    public static function log($output, $status = "OK"){
        $logout = array("message" => $output, "status" => $status);
        array_push(self::log, $logout);
    }
    public static function returnLog(){
        echo(json_encode(self::$log));
    }
}