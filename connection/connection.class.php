<?php

class Connection {

    private static $instance;

    public function getConnection(){
        if (!isset(self::$instance)) {
            $host = "ec2-50-17-203-51.compute-1.amazonaws.com";
            $bd = "d3fojnmd347snk";
            $usuario = "uwhshamplcagcm";
            $senha = "391c8eb28133c27ef74b21918aabc7dbdaccdefb12e3ee3811d9f9a891a0baa7";
            $port = "5432";
            
            self::$instance = new PDO('pgsql:host=' . $host .";port=" . $port . 
		';dbname=' . $bd, $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));            
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
     
        return self::$instance;
    }

    public function printError($error){
        echo $error[2];
    }

}

?>
