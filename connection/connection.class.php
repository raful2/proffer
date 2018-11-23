<?php

class Connection {

    private static $instance;

    public function getConnection(){
        if (!isset(self::$instance)) {
            $host = "labsql.fapce.edu.br";
            $bd = "fap_2018_2";
            $usuario = "mbd_2017210043";
            $senha = "867675ra";
            $port = "3024";

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
