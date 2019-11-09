<?php
$usuario='WEBUSERMYM';
$pass='web2014';
    //$usuario=strtoupper($usuario);
    $dbconect = odbc_connect("conexrgr", $usuario, $pass);    
    if ($dbconect == 0) {
        $sqlerror = odbc_errormsg($dbconect);
        $result=0;
    }else{
        $result=1;
    }
?>

