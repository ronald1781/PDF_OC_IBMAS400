<?php
    $usuario=strtoupper($usuario);//conexrgr,conexd
    $dbconect = odbc_connect("conexd", $usuario, $password);    
    if ($dbconect == 0) {
        $sqlerror = odbc_errormsg($dbconect);
        $result=0;
    }else{
        $result=1;
    }
?>

