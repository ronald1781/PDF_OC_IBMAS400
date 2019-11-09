<?php
$usuario='sa';
$password='s@pcore2828';

    $usuario=$usuario;//conexrgr,conexd
    $sqlconect = odbc_connect("anexup", $usuario, $password);    
    if ($sqlconect == 0) {
        $sqlerror = odbc_errormsg($sqlconect);
        $result=0;
    }else{
        $result=1;
    }
?>

