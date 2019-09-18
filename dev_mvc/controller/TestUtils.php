<?php


class TestUtils{
    public static $log = [];
    public static $status;
    public static function log($output, $status = "OK"){
        array_push(self::log, array("message" => $output, "status" => $status));
    }
    public static function returnLog(){
        echo(json_encode(self::$log));
    }
}